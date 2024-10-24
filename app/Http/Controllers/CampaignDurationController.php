<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CampaignDuration;
use App\Models\Campaign;
use App\Models\Game;
use Yajra\DataTables\Facades\DataTables;

class CampaignDurationController extends Controller
{

    public function __construct()
    {
        $this->handleMsisdn();
    }


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
        $games = Game::all();
        return view('campaign.campaign-durations.show', compact('campaign','games'));
    }




    public function store(Request $request)
    {
       try {

        

        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);


        if ($validator->fails()) {
            toastr()->addError($validator->errors()->first());
            return redirect()->back();
        }

        // convert 12 hour time to 24 hour time
        // 2024-04-29 14:47:18
        $start_datetime = $request->start_date . ' ' . $request->start_time;
        $start_datetime = date("Y-m-d H:i:s", strtotime($start_datetime));

        $end_dateTime = $request->end_date . ' ' . $request->end_time;
        $end_dateTime = date("Y-m-d H:i:s", strtotime($end_dateTime));


        $campaign = Campaign::find($request->campaign_id);
        $campaignDuration = new CampaignDuration();
        $campaignDuration->campaign_id = $request->campaign_id;
        $campaignDuration->name = $request->name;
        $campaignDuration->amount = $request->amount;
        $campaignDuration->play_type = $campaign? $campaign->play_type : 'campaign';
        $campaignDuration->status = $request->status;
        $campaignDuration->game_id = $request->game_id;
        $campaignDuration->start_date_time = $start_datetime;
        $campaignDuration->end_date_time = $end_dateTime;
        $campaignDuration->save();
        flash()->addSuccess('Campaign duration created successfully');
        return redirect()->back();

       } catch (\Throwable $th) {
            flash()->addError($th->getMessage());
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
                'amount' => 'required',
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
            $campaignDuration->amount = $request->amount;
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
