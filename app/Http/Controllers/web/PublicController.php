<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CampaignDuration;
use App\Models\Game;
use App\Models\BkashPayment;
use Carbon\Carbon;
use App\Models\Score;

class PublicController extends Controller
{
    public function __construct()
    {
        $this->handleMsisdn();
    }

    public function dashboard()
    {
        $authUser = Auth::user();
        return view('public.dashboard', compact('authUser'));
    }

    // leaderboard
    public function leaderboard($id = null)
    {
        if ($id) {
            $today = Carbon::today();
            $get_scores = Score::whereDate('date_time', $today)->get();
            $daily_scores = $get_scores->sortByDesc('score')->values()->all();
            $scoresThisGrand = Score::all();
            $grandly_scores = $scoresThisGrand->sortByDesc('score')->values()->all();

            return view('public.leaderboard.show', compact('daily_scores','grandly_scores'));
        }else{
            return redirect()->back();
        }
    }

    // description
    public function campaignDetails($id)
    {
        $currentDate = Carbon::now()->toDateTimeString();
        $campaignDuration = CampaignDuration::select()->where('id',$id)->with('game')->first();
        $game = Game::select()->first();

        $msisdn = $this->get_msisdn();


        return view('public.description',compact('game','campaignDuration','currentDate','msisdn'));
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

    // playNow
    public function playNow($campaign_duration_id){
        try {
            $campaignDuration = CampaignDuration::select()->where('id',$campaign_duration_id)->first();
            $url = $campaignDuration->gameURL($campaignDuration);

            $findGame = Game::find($campaignDuration->game_id);



            $score = Score::select()
                ->where('msisdn', Auth::user()->msisdn)
                ->where('game_keyword', $findGame->keyword)
                ->where('campaign_id', $campaignDuration->campaign_id)
                ->where('campaign_duration_id', $campaignDuration->id)
                ->first();
            if(!$score){
                $score = new Score();
                $setScore = 0;
            }else{
                $setScore = (int)$score->score;
            }


            $score->campaign_id = $campaignDuration->campaign_id;
            $score->campaign_duration_id = $campaignDuration->id;
            $score->msisdn = Auth::user()->msisdn;
            $score->score = $setScore;
            $score->game_keyword = $findGame->keyword;
            $score->save();

            return redirect($url);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
