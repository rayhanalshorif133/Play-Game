<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Campaign;
use App\Models\CampaignDuration;
use Carbon\Carbon;

class TournamentController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->toDateTimeString(); //

        $currentTournamentDurations = CampaignDuration::select()
            ->where('start_date_time', '<=', $currentDate)
            ->where('end_date_time', '>', $currentDate)
            ->where('play_type','tournament')
            ->with('campaign')
            ->get();

        
        $currentTournamentDurations->each(function($tournamentDuration){
            $tournamentDuration->duration = $this->calculateDuration($tournamentDuration);
        });


        // upcomingCampaignDurations
        $upcomingTournamentDurations = CampaignDuration::select()
        ->where('start_date_time', '>', $currentDate)
        ->where('play_type','tournament')
        ->with('campaign')
        ->get();
        
        $upcomingTournamentDurations->each(function($item){
            $item->duration = $this->calculateDurationUpcoming($item);
        });

        return view('public.tournament',compact('currentTournamentDurations', 'upcomingTournamentDurations'));
    }


    protected function calculateDurationUpcoming($tournamentDurations)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($tournamentDurations->start_date_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        // return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }

    protected function calculateDuration($tournamentDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($tournamentDuration->end_date_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        // return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }


}
