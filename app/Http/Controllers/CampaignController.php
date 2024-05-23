<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use App\Models\Game;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Campaign::orderBy('created_at', 'desc')
                ->with('createdBy')
                ->get();
             return DataTables::of($query)
             ->addIndexColumn()
             ->rawColumns(['action'])
             ->toJson();
        }
        $games = Game::all();
        return view('campaign.index',compact('games'));
    }

    // fetchCampaign
    public function fetchCampaign($id)
    {
        $campaign = Campaign::select()
            ->where('id', $id)
            ->with('createdBy','updatedBy')
            ->first();
        return $this->respondWithSuccess('Campaign fetched successfully.', $campaign);
    }




    // create
    public function create()
    {
        return view('campaign.create');
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'type' => 'required',
                'status' => 'required',
                'play_type' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->addError($validator->errors()->first());
                return redirect()->back();
            }


            // type
            if($request->type == 'quiz'){
                $validator = Validator::make($request->all(), [
                    'total_questions' => 'required',
                    'per_question_score' => 'required',
                    'per_q_time_limit' => 'required',
                ]);
                if ($validator->fails()) {
                    toastr()->addError($validator->errors()->first());
                    return redirect()->back();
                }
            }


            $campaign = new Campaign();
            $campaign->title = $request->title;
            $campaign->type = $request->type;
            $campaign->play_type = $request->play_type;
            $campaign->per_q_time_limit = $request->per_q_time_limit;
            $campaign->total_time_limit = (int)$request->per_q_time_limit * (int)$request->total_questions;
            $campaign->total_questions = $request->total_questions;
            $campaign->per_question_score = $request->per_question_score;
            $campaign->status = $request->status;
            $campaign->description = $request->description;

            if ($request->thumbnail) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('/images/campaign/thumbnail'), $thumbnail_name);
                $thumbnail_name = '/images/campaign/thumbnail/' . $thumbnail_name;
                $campaign->thumbnail = $thumbnail_name;
            }

            if ($request->banner) {
                $banner = $request->file('banner');
                $banner_name = time() . '_' . $banner->getClientOriginalName();
                $banner->move(public_path('/images/campaign/banner'), $banner_name);
                $banner_name = '/images/campaign/banner/' . $banner_name;
                $campaign->banner = $banner_name;
            }

            $campaign->created_by = auth()->user()->id;
            $campaign->updated_by = auth()->user()->id;
            $campaign->save();
            toastr()->addSuccess('Campaign added successfully.');
            return redirect()->route('admin.campaigns.index');

        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->route('admin.campaigns.index');
        }
    }

    // edit
    public function edit($id)
    {
        $campaign = Campaign::select()
            ->where('id', $id)
            ->with('createdBy','updatedBy')
            ->first();
        return view('campaign.edit', compact('campaign'));
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'type' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->addError($validator->errors()->first());
                return redirect()->back();
            }


            // type
            if($request->type == 'quiz'){
                $validator = Validator::make($request->all(), [
                    'total_time_limit' => 'required',
                    'total_questions' => 'required',
                    'per_question_score' => 'required',
                ]);
                if ($validator->fails()) {
                    toastr()->addError($validator->errors()->first());
                    return redirect()->back();
                }
            }else{
                $request->total_time_limit = null;
                $request->total_questions = null;
                $request->per_question_score = null;
            }

            $campaign = Campaign::find($id);
            $campaign->title = $request->title;
            $campaign->type = $request->type;
            $campaign->total_time_limit = $request->total_time_limit;
            $campaign->total_questions = $request->total_questions;
            $campaign->per_question_score = $request->per_question_score;
            $campaign->status = $request->status;
            $campaign->description = $request->description;

            if ($request->thumbnail) {

                if ($campaign->thumbnail) {
                    if (file_exists(public_path($campaign->thumbnail))) {
                        unlink(public_path($campaign->thumbnail));
                    }
                }

                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('/images/campaign/thumbnail'), $thumbnail_name);
                $thumbnail_name = 'images/campaign/thumbnail/' . $thumbnail_name;
                $campaign->thumbnail = $thumbnail_name;
            }

            if ($request->banner) {

                if ($campaign->banner) {
                    if (file_exists(public_path($campaign->banner))) {
                        unlink(public_path($campaign->banner));
                    }
                }

                $banner = $request->file('banner');
                $banner_name = time() . '_' . $banner->getClientOriginalName();
                $banner->move(public_path('/images/campaign/banner'), $banner_name);
                $banner_name = 'images/campaign/banner/' . $banner_name;
                $campaign->banner = $banner_name;
            }

            $campaign->updated_by = auth()->user()->id;
            $campaign->save();
            toastr()->addSuccess('Campaign updated successfully.');
            return redirect()->route('admin.campaigns.index');

        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->route('admin.campaigns.index');
        }
    }

    // delete
    public function delete($id)
    {
        try {
            $campaign = Campaign::find($id);
            if ($campaign->thumbnail) {
                if (file_exists(public_path($campaign->thumbnail))) {
                    unlink(public_path($campaign->thumbnail));
                }
            }
            if ($campaign->banner) {
                if (file_exists(public_path($campaign->banner))) {
                    unlink(public_path($campaign->banner));
                }
            }
            $campaign->delete();
            return $this->respondWithSuccess('Campaign deleted successfully.');
        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->route('admin.campaigns.index');
        }
    }



    // playNow 
    public function campaignDetails($campaign_id)
    {
        if(Auth::check()){
            return view('public.campaign.details',compact('campaign_id'));
        }else{
            return redirect()->route('public.login');
        }
    }
}
