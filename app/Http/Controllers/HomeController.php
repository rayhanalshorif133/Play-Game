<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\Subscription;
use App\Models\Game;
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

        $campaignDuration = CampaignDuration::select()
            ->where('play_type', 'campaign', 'game')
            ->with('campaign')
            ->first();
        if ($campaignDuration->start_date_time <= $currentDate && $campaignDuration->end_date_time >= $currentDate) {
            $campaignDuration->type = 'current'; // The campaign is currently active
            $campaignDuration->duration = $this->calculateDuration($campaignDuration);
        } else if ($campaignDuration->start_date_time > $currentDate) {
            $campaignDuration->type = 'upcoming'; // The campaign is set to start in the future
            $campaignDuration->duration = $this->calculateDurationUpcoming($campaignDuration);
        } else if($campaignDuration->end_date_time < $currentDate){
            $campaignDuration->type = 'expired'; // The campaign has ended
            $campaignDuration->duration = null;
        }

        $hasAlreadySubs = false;

        $isSubs = Subscription::where('msisdn', '=', $this->get_msisdn())
            ->where('status', '=', 1)
            ->first();

        if ($isSubs) {
            $hasAlreadySubs = true;
        }


        return view('public.home', compact('game', 'campaignDuration', 'hasAlreadySubs'));
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
