<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class CampaignScoreLogController extends Controller
{
    // index
    public function index(Request $request)
    {

        if (request()->ajax()) {

            
            $date = date('Y-m-d');
            $campaign = $this->getCurrentCampaign();
            $campaign_id = $campaign->id;
            
            if ($request->type == 'daily' && $request->date && $request->campaign_id) {
                $date = $request->date;
                $campaign_id = $request->campaign_id;
            }else if ($request->campaign_id) {
                $campaign_id = $request->campaign_id;
            }

            if ($request->type == 'daily') {

                $scores = Score::select(
                    'campaigns.name as camp_name',
                    'scores.campaign_id as campaign_id',
                    DB::raw('MAX(scores.date_time) as date'),
                    'msisdn',
                    DB::raw('SUM(score) as total_score')
                )
                    ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                    ->where('scores.campaign_id', $campaign_id)
                    ->where('scores.status', 1)
                    ->whereDate('scores.date_time', $date)
                    ->groupBy('msisdn', 'campaign_id', 'campaigns.name')
                    ->orderBy('total_score', 'desc')
                    ->get();
            } else {
                $scores = Score::select(
                    'campaigns.name as camp_name',
                    'scores.campaign_id as campaign_id',
                    DB::raw('MAX(scores.date_time) as date'),
                    'msisdn',
                    DB::raw('SUM(score) as total_score')
                )
                    ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                    ->where('scores.campaign_id', $campaign_id)
                    ->where('scores.status', 1)
                    ->groupBy('msisdn', 'campaign_id', 'campaigns.name')
                    ->orderBy('total_score', 'desc')
                    ->get();
            }
            return DataTables::of($scores)
                ->addIndexColumn()
                ->toJson();
        }

        $campaigns = Campaign::all();
        $active_camp = $this->getCurrentCampaign();
        return view('campaign_score_logs.index', compact('campaigns','active_camp'));
    }
    // scoreLogs
    public function scoreLogs(Request $request)
    {

        if (request()->ajax()) {
            $scores = Score::select()
                ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                ->get();

            if ($request->date) {
                $scores = Score::select()
                    ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                    ->whereDate('scores.date_time', $request->date) // Filter by the date part only
                    ->get();
            }
            return DataTables::of($scores)
                ->addIndexColumn()
                ->toJson();
        }

        $campaigns = Campaign::all();
        return view('campaign_score_logs.score-logs', compact('campaigns'));
    }
}
