<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Campaign;
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
        return view('campaign.index');
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
            }


            $campaign = new Campaign();
            $campaign->title = $request->title;
            $campaign->type = $request->type;
            $campaign->total_time_limit = $request->total_time_limit;
            $campaign->total_questions = $request->total_questions;
            $campaign->per_question_score = $request->per_question_score;
            $campaign->status = $request->status;
            $campaign->description = $request->description;

            if ($request->thumbnail) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('/images/campaign/thumbnail'), $thumbnail_name);
                $thumbnail_name = 'images/campaign/thumbnail/' . $thumbnail_name;
                $campaign->thumbnail = $thumbnail_name;
            }

            if ($request->banner) {
                $banner = $request->file('banner');
                $banner_name = time() . '_' . $banner->getClientOriginalName();
                $banner->move(public_path('/images/campaign/banner'), $banner_name);
                $banner_name = 'images/campaign/banner/' . $banner_name;
                $campaign->banner = $banner_name;
            }

            $campaign->created_by = auth()->user()->id;
            $campaign->updated_by = auth()->user()->id;
            $campaign->save();
            toastr()->addSuccess('Campaign added successfully.');
            return redirect()->route('campaigns.index');

        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->route('campaigns.index');
        }
    }
}
