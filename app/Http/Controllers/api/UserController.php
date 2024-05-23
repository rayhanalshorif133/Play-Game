<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\ScoreLog;

class UserController extends Controller
{

    // msisdn=8801323174104&keyword=mergeDice
    public function checkEligibleUser(Request $request)
    {


        $msisdn = $request->msisdn;
        $game_keyword = $request->keyword;

        if ($msisdn == null || $game_keyword == null) {
            return response()->json('Invalid Request');
        }

        $data= [
            'status' => true
        ];


        return response()->json($data, 200);

    }
}
