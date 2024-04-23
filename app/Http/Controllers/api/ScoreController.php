<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // score
    public function score(Request $request)
    {


        $msisdn = $request->msisdn;
        $score = $request->score;
        $game_keyword = $request->keyword;

        return response()->json('Success');
    }
}
