<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\Subscription;
use App\Models\Game;
use App\Models\Score;
use App\Models\CampaignDuration;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->handleMsisdn();
    }


    public function isLoginOrNot()
    {
        return redirect()->route('home');
        if (Auth::check()) {
            $this->middleware('auth');
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }
        return redirect()->route('home');
    }

    // admin
    public function admin()
    {
        $this->middleware('auth');
        return redirect()->route('admin.dashboard');
    }

    // home
    public function home()
    {


        $game = Game::select()->first();
        $currentDate = Carbon::now()->toDateTimeString(); //



        $campaign = Campaign::select()->where('status', 1)->first();
        if ($campaign && $campaign->start_date_time <= $currentDate && $campaign->end_date_time >= $currentDate) {
            $campaign->type = 'current'; // The campaign is currently active
            $campaign->duration = $this->calculateDuration($campaign);
        } else if ($campaign && $campaign->start_date_time > $currentDate) {
            $campaign->type = 'upcoming'; // The campaign is set to start in the future
            $campaign->duration = $this->calculateDurationUpcoming($campaign);
        } else if($campaign && $campaign->end_date_time < $currentDate){
            $campaign->type = 'expired'; // The campaign has ended
            $campaign->duration = null;
        }



        $hasAlreadySubs = false;

        $isSubs = Subscription::where('msisdn', '=', $this->get_msisdn())
            ->where('status', '=', 1)
            ->first();
        $subscription = Subscription::select()->where('status', '1')->count();

        if ($isSubs) {
            $hasAlreadySubs = true;
        }

        $scores = Score::select('msisdn', DB::raw('SUM(score) as total_score'))
                ->where('status', '=', 1)
                ->groupBy('msisdn')
                ->orderBy('total_score', 'desc')
                ->get();
        return view('public.home', compact('scores','game','subscription', 'campaign', 'hasAlreadySubs'));
    }

    // calculateDurationUpcoming
    protected function calculateDurationUpcoming($campaignDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaignDuration->start_date_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }

    protected function calculateDuration($campaignDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaignDuration->end_date_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        // return $days . 'd ' . $hours . 'h ';
    }

    public function index()
    {
        $this->middleware('auth');

        return view('admin.dashboard');
    }
}
