<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\Subscription;
use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use App\Models\CampaignDuration;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->handleMsisdn();

        if (Auth::check()) {
            $this->middleware('auth');
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }
    }


    public function isLoginOrNot()
    {
        // return redirect()->route('home');

        return $this->home();
        // return redirect()->route('home');
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

        $user  = '';



        $campaign = $this->getCurrentCampaign();



        if ($campaign && $campaign->start_date_time <= $currentDate && $campaign->end_date_time >= $currentDate) {
            $campaign->type = 'current'; // The campaign is currently active
            $campaign->duration = $this->calculateDuration($campaign);
        } else if ($campaign && $campaign->start_date_time > $currentDate) {
            $campaign->type = 'upcoming'; // The campaign is set to start in the future
            $campaign->duration = $this->calculateDurationUpcoming($campaign);
        } else if ($campaign && $campaign->end_date_time < $currentDate) {
            $campaign->type = 'expired'; // The campaign has ended
            $campaign->duration = null;
        }




        $hasAlreadySubs = false;
        $msisdn = '';
        $user = '';
        $date = date('Y-m-d');


        if (isset($_COOKIE["player_user"])) {
            $user = $_COOKIE["player_user"];
            $user = json_decode($user, true);
            $msisdn = $user['msisdn'];
            $user = User::where('msisdn', '=',  $msisdn)->where('status', 1)->first();
            if ($user) {
                $isSubs = Subscription::where('msisdn', '=',  $user->msisdn)
                    ->where('status', '=', 1)
                    ->whereDate('subs_date', $date)
                    ->first();
                if ($isSubs) {
                    $hasAlreadySubs = true;
                }
            } else {
                setcookie("player_user", "", time() - (86400 * 1), "/");
            }
        }

        if ($campaign) {
            $subscription = Subscription::select()
                ->where('status', '1')
                ->where('campaign_id', $campaign->id)
                ->whereDate('subs_date', $date)
                ->count();
        } else {
            $subscription = 0;
        }

        // For Daily campaign
        $scores = Score::select('msisdn', DB::raw('SUM(score) as total_score'))
            ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
            ->where('scores.status', '=', 1)
            ->where('campaigns.id', '=', $campaign->id)
            ->whereDate('scores.date_time', '=', $date)
            ->groupBy('msisdn', 'campaign_id', 'campaigns.status')
            ->orderBy('total_score', 'desc')
            ->get()
            ->take(20);

        // For Daily campaign
        $weekly_scores = Score::select('msisdn', DB::raw('SUM(score) as total_score'))
            ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
            ->where('scores.status', '=', 1)
            ->where('campaigns.id', '=', $campaign->id)
            ->groupBy('msisdn', 'campaign_id', 'campaigns.status')
            ->orderBy('total_score', 'desc')
            ->get()
            ->take(20);






        return view('public.home', compact('user', 'scores', 'weekly_scores', 'msisdn', 'game', 'subscription', 'campaign', 'hasAlreadySubs'));
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
