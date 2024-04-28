<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\CampaignDuration;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function isLoginOrNot()
    {
        if(Auth::check()){
            $this->middleware('auth');
            if(Auth::user()->role == 'admin'){
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

        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $currentCampaignDurations = CampaignDuration::select()
            // ->where('start_date', '<=', $currentDate)
            // ->where('start_time', '<', $currentTime)
            // ->where('end_date', '>', $currentDate)
            ->get();
        
        $currentCampaignDurations->each(function($campaignDuration){
            if($campaignDuration->end_date ==  date('Y-m-d')){
                if($campaignDuration->end_time < date('H:i:s')){
                    // unset($campaignDuration);
                }
            }
            $campaignDuration->campaign_details = Campaign::find($campaignDuration->campaign_id);
            $campaignDuration->duration = $this->calculateDuration($campaignDuration);
        });

        // upcomingCampaignDurations
        $upcomingCampaignDurations = CampaignDuration::select()
        ->where('start_date', '>', $currentDate)
        ->get();
        
        $upcomingCampaignDurations->each(function($campaignDuration){
            $campaignDuration->campaign_details = Campaign::find($campaignDuration->campaign_id);
            $campaignDuration->duration = $this->calculateDurationUpcoming($campaignDuration);
        });

        return view('public.home', compact('currentCampaignDurations', 'upcomingCampaignDurations'));
    }

    // calculateDurationUpcoming
    protected function calculateDurationUpcoming($campaignDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaignDuration->start_date . ' ' . $campaignDuration->start_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        // return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }

    protected function calculateDuration($campaignDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaignDuration->end_date . ' ' . $campaignDuration->end_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        // return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }

    public function index()
    {
        $this->middleware('auth');
        return view('admin.dashboard');
    }
}
