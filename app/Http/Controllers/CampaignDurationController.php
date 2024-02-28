<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CampaignDuration;

class CampaignDurationController extends Controller
{
    public function index()
    {
        return view('campaign-durations.index');
    }


    public function create()
    {
        return view('campaign-durations.create');
    }

    public function edit($id)
    {
        return view('campaign-durations.edit', compact('id'));
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

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Campaign duration updated successfully']);
    }

    public function delete($id)
    {
        return response()->json(['message' => 'Campaign duration deleted successfully']);
    }
}
