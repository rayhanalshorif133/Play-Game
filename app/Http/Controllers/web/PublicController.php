<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use App\Models\Game;
use App\Models\BkashPayment;
use Carbon\Carbon;
use App\Models\Score;

class PublicController extends Controller
{

    public function dashboard()
    {
        $authUser = Auth::user();
        return view('public.dashboard', compact('authUser'));
    }


    // description
    public function campaignDetails($id)
    {
        $currentDate = Carbon::now()->toDateTimeString();
        $campaign = Campaign::select()->where('id',$id)->first();
        $game = Game::select()->first();

        $msisdn = $this->get_msisdn();


        return view('public.description',compact('game','campaign','currentDate','msisdn'));
    }

    public function playerProfile(){
        return view('public.playerProfile');
    }




}
