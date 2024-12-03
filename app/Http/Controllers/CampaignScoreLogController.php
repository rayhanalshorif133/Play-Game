<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CampaignScoreLogController extends Controller
{
    // index
    public function index(Request $request)
    {



        if ($request->type == 'reportExport') {
            $campaign = Campaign::select('id', 'name', 'start_date', 'end_date')->where('id', $request->campaign_id)->first();


            $data = [];

            // Convert start and end date to Carbon instances
            $startDate = Carbon::parse($campaign->start_date);
            $endDate = Carbon::parse($campaign->end_date);

            $startDate = Carbon::parse($campaign->start_date);
            $endDate = Carbon::parse($campaign->end_date);


            // Loop through the dates from start_date to end_date
            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                $GET_date = $date->format('Y-m-d');
                $scores = Score::select(
                    'users.name as name',
                    'scores.msisdn',
                    DB::raw('SUM(score) as total_score'),
                    DB::raw('DATE(scores.date_time) as date')
                )
                    ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                    ->join('users', 'users.msisdn', '=', 'scores.msisdn')
                    ->where('scores.campaign_id', $campaign->id)
                    ->where('scores.status', 1)
                    ->whereDate('scores.date_time', $GET_date)
                    ->groupBy('scores.msisdn', 'users.name', 'date')  // Removed 'campaign_id' from groupBy
                    ->orderBy('total_score', 'desc')
                    ->get();
                array_push($data, $scores);
            }


            $weeklyScores = Score::select(
                'campaigns.name as camp_name',
                'users.name as name',
                'scores.campaign_id as campaign_id',
                'scores.msisdn',
                DB::raw('SUM(scores.score) as total_score'),
                DB::raw('(
            SELECT COUNT(DISTINCT DATE(date_time)) 
            FROM scores AS sub_scores
            WHERE sub_scores.campaign_id = scores.campaign_id
              AND sub_scores.msisdn = scores.msisdn
              AND sub_scores.status = 1
              AND sub_scores.subscription_id != ""
              AND sub_scores.score IS NOT NULL
        ) as participation_count')
            )
                ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                ->join('users', 'users.msisdn', '=', 'scores.msisdn')
                ->where('scores.campaign_id', $campaign->id)
                ->where('scores.status', 1)
                ->groupBy('scores.msisdn', 'scores.campaign_id', 'campaigns.name', 'users.name')
                ->orderBy('total_score', 'desc')
                ->get();


            return $this->respondWithSuccess('export', [$campaign, $data, $weeklyScores]);
        }


        if (request()->ajax()) {

            $date = date('Y-m-d');
            $campaign = $this->getCurrentCampaign();
            $campaign_id = $campaign->id;

            if ($request->type == 'daily' && $request->date && $request->campaign_id) {
                $date = $request->date;
                $campaign_id = $request->campaign_id;
            } else if ($request->campaign_id) {
                $campaign_id = $request->campaign_id;
            }

            if ($request->type == 'daily') {

                $scores = Score::select(
                    'campaigns.name as camp_name',
                    'users.name as user_name',
                    'scores.campaign_id as campaign_id',
                    'scores.msisdn',
                    DB::raw('SUM(score) as total_score'),
                    DB::raw('DATE(scores.date_time) as date')
                )
                    ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                    ->join('users', 'users.msisdn', '=', 'scores.msisdn')
                    ->where('scores.campaign_id', $campaign_id)
                    ->where('scores.status', 1)
                    ->whereDate('scores.date_time', $date)
                    ->groupBy('scores.msisdn', 'scores.campaign_id', 'campaigns.name', 'users.name', 'date')  // Grouping by the extracted date
                    ->orderBy('total_score', 'desc')
                    ->get();
            } else {

                $scores = Score::select(
                    'campaigns.name as camp_name',
                    'users.name as user_name',
                    'scores.campaign_id as campaign_id',
                    'scores.msisdn',
                    DB::raw('SUM(scores.score) as total_score'),
                    DB::raw('(
                SELECT COUNT(DISTINCT DATE(date_time)) 
                FROM scores AS sub_scores
                WHERE sub_scores.campaign_id = scores.campaign_id
                  AND sub_scores.msisdn = scores.msisdn
                  AND sub_scores.status = 1
                  AND sub_scores.subscription_id != ""
                  AND sub_scores.score IS NOT NULL
            ) as participation_count')
                )
                    ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                    ->join('users', 'users.msisdn', '=', 'scores.msisdn')
                    ->where('scores.campaign_id', $campaign_id)
                    ->where('scores.status', 1)
                    ->groupBy('scores.msisdn', 'scores.campaign_id', 'campaigns.name', 'users.name')
                    ->orderBy('total_score', 'desc')
                    ->get();
            }
            return DataTables::of($scores)
                ->addIndexColumn()
                ->toJson();
        }

        $campaigns = Campaign::all();
        $active_camp = $this->getCurrentCampaign();
        return view('campaign_score_logs.leaderboard', compact('campaigns', 'active_camp'));
    }
    // scoreLogs
    public function scoreLogs(Request $request)
    {




        if (request()->ajax()) {

            $date = $request->date ? $request->date : date('Y-m-d');
            $scores = Score::select(
                'users.name as user_name',
                'campaigns.name as camp_name',
                'users.msisdn',
                'scores.score',
                'scores.date_time as date_time',
                'scores.status as status',
            )
                ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
                ->join('users', 'users.msisdn', '=', 'scores.msisdn')
                ->whereDate('scores.date_time', $date)
                ->get();
            return DataTables::of($scores)
                ->addIndexColumn()
                ->toJson();
        }

        $campaigns = Campaign::all();
        return view('campaign_score_logs.score-logs', compact('campaigns'));
    }
}
