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
use App\Models\HitLog;
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
    public function home(Request $request)
    {



       $hitlog =  HitLog::create([
            'ip_address' => $this->getUserIP(),
            'query_string' => $_SERVER['QUERY_STRING'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'additional_info' => $this->getCurrentUrl(),
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        ]);


        $hasMyGP = $hitlog->query_string;

        if($hasMyGP == 'source=MYGP'){
            setcookie("channel", "MYGP", time() + (86400 * 1), "/");
        }else{
            setcookie("channel", "", time() - (86400 * 1), "/");
        }






        $game = Game::select()->first();
        $currentDate = Carbon::now()->toDateTimeString(); //

        $user  = '';



        $campaign = $this->getCurrentCampaign();

        $campaign->type = 'current'; // The campaign is currently active
        $campaign->duration = $this->calculateDuration($campaign);



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

        $totalUser = User::select()->count();

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
        $weekly_scores = Score::select('msisdn', DB::raw('SUM(score) as total_score'),
        DB::raw('(
            SELECT COUNT(DISTINCT DATE(date_time)) 
            FROM scores AS sub_scores
            WHERE sub_scores.campaign_id = scores.campaign_id
              AND sub_scores.msisdn = scores.msisdn
              AND sub_scores.status = 1
              AND sub_scores.subscription_id != ""
              AND sub_scores.score IS NOT NULL
        ) as participation_count'))
            ->join('campaigns', 'campaigns.id', '=', 'scores.campaign_id')
            ->where('scores.status', '=', 1)
            ->where('campaigns.id', '=', $campaign->id)
            ->groupBy('msisdn', 'campaign_id', 'campaigns.status')
            ->orderBy('total_score', 'desc')
            ->get()
            ->take(20);


        $current_date = new \DateTime(); // Current date
        $start_date = new \DateTime($campaign->start_date); // Assuming $campaign->start_date is a valid date string
        
        $interval = $current_date->diff($start_date); // Calculate the interval
        $count_days = $interval->days + 1; // Get the number of days

        return view('public.home', compact('user','count_days', 'scores', 'weekly_scores', 'msisdn','totalUser' ,'game', 'campaign', 'hasAlreadySubs'));
    }

    // calculateDurationUpcoming
    protected function calculateDurationUpcoming($campaignDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaignDuration->start_date);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }

    protected function calculateDuration($campaign)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaign->end_date . ' ' . $campaign->end_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
    }

    public function index()
    {
        $this->middleware('auth');

        return view('admin.dashboard');
    }



    function getUserIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP from shared internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP passed from a proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Direct IP address
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function getCurrentUrl()
    {
        // Check for HTTPS
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

        // Get the domain name (host) and port if necessary
        $host = $_SERVER['HTTP_HOST'];

        // Get the current request URI (path + query string)
        $uri = $_SERVER['REQUEST_URI'];

        // Construct the full URL
        $currentUrl = $protocol . '://' . $host . $uri;

        return $currentUrl;
    }
}
