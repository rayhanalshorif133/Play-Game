<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use App\Models\CampaignDuration;
use App\Models\Game;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class CampaignController extends Controller
{

    function generateCampName($startDate, $endDate)
    {
        // Convert to DateTime objects
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);

        // Format the dates as required
        $startFormatted = $start->format('d');
        $endFormatted = $end->format('d-m-Y');

        // Return the name format
        return "Camp - $startFormatted to $endFormatted";
    }


    public function index(Request $request)
    {


        $games = Game::first();
        if ($request->method() == 'GET') {
            if ($request->type == 'fetch') {
                $campaign = Campaign::select()->where('id', $request->id)->first();
                return $this->respondWithSuccess('Successfully fetched campaign', $campaign);
            } else {
                $getCurrentCamp = $this->getCurrentCampaign();
                if (request()->ajax()) {
                    $query = Campaign::orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($campaign) use ($getCurrentCamp) {
                            $campaign->type = ($campaign->id == $getCurrentCamp->id) ? 'current' : 'regular';
                            return $campaign;
                        });
                    return DataTables::of($query)->addIndexColumn()->toJson();
                }
                return view('campaign.index', compact('games'));
            }
        } elseif ($request->method() == 'POST') {

            try {






                $start_date_time = Carbon::createFromFormat('Y-m-d\TH:i',  $request->start_date_time);
                $end_date_time = Carbon::createFromFormat('Y-m-d\TH:i',  $request->end_date_time);

                // // Create a new campaign
                $campaign = Campaign::create([
                    'name' => $this->generateCampName($start_date_time, $end_date_time),
                    'amount' => $request->amount ? $request->amount : 10,
                    'description' => $request->description,
                    'start_date' => $start_date_time->toDateString(),
                    'start_time' => $start_date_time->toTimeString(),
                    'end_date' => $end_date_time->toDateString(),
                    'end_time' => $end_date_time->toTimeString(),
                    'status' => $request->status,
                ]);

                return $this->respondWithSuccess('success', 'Campaign created successfully');
            } catch (ValidationException $e) {

                return $this->respondWithError('Validation errors occurred', $e->errors());
            }
        } elseif ($request->method() == 'PUT') {
            if ($request->type == 'status') {


                $campaign = Campaign::select()->where('id', $request->id)->first();
                $campaign->status = $campaign->status == 1 ? 0 : 1;
                $campaign->save();
                return $this->respondWithSuccess('yes status', $request->all());
            } else {

                $campaign = Campaign::find($request->id);
                $start_date_time = Carbon::createFromFormat('Y-m-d\TH:i',  $request->start_date_time);
                $end_date_time = Carbon::createFromFormat('Y-m-d\TH:i',  $request->end_date_time);


                // Update campaign attributes
                $campaign->name = $request->name ? $request->name : $this->generateCampName($start_date_time, $end_date_time);
                $campaign->amount = $request->amount ? $request->amount : 10;
                $campaign->description = $request->description;
                $campaign->start_date = $start_date_time->toDateString();
                $campaign->start_time = $start_date_time->toTimeString();
                $campaign->end_date = $end_date_time->toDateString();
                $campaign->end_time = $end_date_time->toTimeString();
                $campaign->status = $campaign->status;
                $campaign->save();



                return $this->respondWithSuccess('yes update', $campaign);
            }
        } else {
            $start_date = $request->start_date;
            $start_time = $request->start_time;
            $end_date = $request->end_date;
            $end_time = $request->end_time;

            $startDateTime = Carbon::createFromFormat('Y-m-d H:i', "$start_date $start_time");
            $end_date_time = Carbon::createFromFormat('Y-m-d H:i', "$end_date $end_time");
            $campaignDuration->start_date_time = $startDateTime->toDateTimeString();
            $campaignDuration->end_date_time = $end_date_time->toDateTimeString();
            $campaignDuration->save();
            Session::flash('success', 'Campaign Duration Time Updated Successfully');
            return redirect()->back();
        }
    }

    // fetchCampaign
    public function fetchCampaigns(Request $request)
    {

        if ($request->type == 'last-campaign') {
            $campaign = Campaign::orderBy('id', 'desc')->first();
            return $this->respondWithSuccess('Campaign fetched successfully.', $campaign);
        } else {
            return $this->respondWithSuccess('Campaign fetched successfully.', []);
        }
    }


    public function fetchCampaign($id)
    {
        $campaign = Campaign::select()
            ->where('id', $id)
            ->with('createdBy', 'updatedBy')
            ->first();
        return $this->respondWithSuccess('Campaign fetched successfully.', $campaign);
    }




    // create
    public function create()
    {
        return view('campaign.create');
    }

    public function store(Request $request)
    {
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
            if ($request->type == 'quiz') {
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
            ->with('createdBy', 'updatedBy')
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
            if ($request->type == 'quiz') {
                $validator = Validator::make($request->all(), [
                    'total_time_limit' => 'required',
                    'total_questions' => 'required',
                    'per_question_score' => 'required',
                ]);
                if ($validator->fails()) {
                    toastr()->addError($validator->errors()->first());
                    return redirect()->back();
                }
            } else {
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
        if (Auth::check()) {
            return view('public.campaign.details', compact('campaign_id'));
        } else {
            return redirect()->route('public.login');
        }
    }
}
