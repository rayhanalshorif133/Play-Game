<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CampaignDuration;
use App\Models\Campaign;
use Yajra\DataTables\Facades\DataTables;

class CampaignDurationController extends Controller
{
    public function index($campaign_id)
    {
        if (request()->ajax()) {
            $query = CampaignDuration::orderBy('created_at', 'asc')
            ->where('campaign_id', $campaign_id)
            ->get();
             return DataTables::of($query)
             ->addIndexColumn()
             ->rawColumns(['action'])
             ->toJson();
        }

        $campaign = Campaign::find($campaign_id);
        return view('campaign.campaign-durations.show', compact('campaign'));
    }




    public function store(Request $request)
    {
       try {

        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        if ($validator->fails()) {
            toastr()->addError($validator->errors()->first());
            return redirect()->back();
        }

        $campaignDuration = new CampaignDuration();
        $campaignDuration->campaign_id = $request->campaign_id;
        $campaignDuration->name = $request->name;
        $campaignDuration->status = $request->status;
        $campaignDuration->start_date = $request->start_date;
        $campaignDuration->end_date = $request->end_date;
        $campaignDuration->save();
        toastr()->addSuccess('Campaign duration created successfully');
        return redirect()->back();

       } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->back();
       }
    }

    // fetch
    public function fetch($id)
    {
        $campaignDuration = CampaignDuration::select()->where('id',$id)->with('campaign')->first();
        return $this->respondWithSuccess('Campaign duration fetched successfully', $campaignDuration);
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'campaigndurations_id' => 'required',
                'name' => 'required',
                'status' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->addError($validator->errors()->first());
                return redirect()->back();
            }

            $campaignDuration = CampaignDuration::find($request->campaigndurations_id);
            $campaignDuration->name = $request->name;
            $campaignDuration->status = $request->status;
            $campaignDuration->start_date = $request->start_date;
            $campaignDuration->end_date = $request->end_date;
            $campaignDuration->save();
            toastr()->addSuccess('Campaign duration updated successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $campaignDuration = CampaignDuration::find($id);
            $campaignDuration->delete();
            return $this->respondWithSuccess('Campaign duration deleted successfully');
        } catch (\Throwable $th) {
            return $this->respondWithError($th->getMessage());
        }
    }
}
