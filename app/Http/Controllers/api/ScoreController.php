<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\ScoreLog;

class ScoreController extends Controller
{
    // score
    public function score(Request $request)
    {


        $msisdn = $request->msisdn;
        $get_score = $request->score;
        $game_keyword = $request->keyword;

        if ($msisdn == null || $get_score == null || $game_keyword == null) {
            return response()->json('Invalid Request');
        }



        try {



            $score = Score::select('id')
                ->where('msisdn', $msisdn)
                ->where('game_keyword', $game_keyword)
                ->where('date_time', 'like' , '%'.date('Y-m-d').'%')
                ->first();
            if(!$score){
                $score = new Score();
            }else{
                if((float)$score->score > (float)$get_score){
                    $get_score = $score->score;
                }
            }
            $score->msisdn = $msisdn;
            $score->score = $get_score;
            $score->game_keyword = $game_keyword;
            $score->status = 1;
            $score->url = $request->url;
            $score->date_time = date('Y-m-d H:i:s');
            $score->duration = $request->duration;
            $score->ip_address = 'localhost';
            $score->user_agent = $request->header('User-Agent');
            $score->referrer = $request->header('referer');
            $score->save();




            $ScoreLog = new ScoreLog();
            $ScoreLog->msisdn = $msisdn;
            $ScoreLog->score = $get_score;
            $ScoreLog->game_keyword = $game_keyword;
            $ScoreLog->status = 1;
            $ScoreLog->url = $request->url;
            $ScoreLog->play_time = date('H:i:s');
            $ScoreLog->play_date = date('Y-m-d');
            $ScoreLog->duration = $request->duration;
            $ScoreLog->ip_address = 'localhost';
            $ScoreLog->user_agent = $request->header('User-Agent');
            $ScoreLog->referrer = $request->header('referer');
            $ScoreLog->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }
}
