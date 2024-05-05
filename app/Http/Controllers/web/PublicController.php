<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CampaignDuration;
use App\Models\BkashPayment;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function dashboard()
    {
        $authUser = Auth::user();
        return view('public.dashboard', compact('authUser'));
    }

    // leaderboard
    public function leaderboard($id = null)
    {
        if ($id) {
            return view('public.leaderboard.show');
        }
        return view('public.leaderboard.index');
    }

    // description
    public function campaignDetails($id)
    {
        $currentDate = Carbon::now()->toDateTimeString(); 
        $campaignDuration = CampaignDuration::select()->where('id',$id)->first();

        if($campaignDuration->start_date_time > $currentDate){
            $upcommingOrCurrent = 'upcomming';
        }else{
            $upcommingOrCurrent = 'current'; 
        }


        $hasAlreadyPayment = false;



        if(Auth::check()){
            $hasPayment = BkashPayment::select()
            ->where('campaign_duration_id',$id)
            ->where('msisdn',Auth::user()->msisdn)
            ->first();
            if($hasPayment){
                $hasAlreadyPayment = true; 
            }
        }
        
        return view('public.description',compact('campaignDuration','hasAlreadyPayment','currentDate'));
    } 
    
   

    // 
    public function campaignAccess(Request $request,$id)
    {
        
        if(Auth::check()){
            return redirect()->back();
        }else{
            return redirect()->route('public.login');
        }
    }

    // 
    public function faq(){
        return view('public.faq');
    }

}
