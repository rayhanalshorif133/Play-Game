<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ScoreController;
use App\Http\Controllers\api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// msisdn
// score
// game_keyword


// https://html5.b2mwap.com/bdgamers/MergeDice/?baseurl="play.b2m-tech.com"&msisdn=8801323174104&keyword=mergeDice

// Notification API (Http Request):

//{{baseurl}}/api/score?msisdn=8801711111111&score=100&keyword=mergeDice
Route::match(['get', 'post'], '/score', [ScoreController::class, 'score']);


// {{baseurl}}/api/redirect?msisdn=8801711111111&keyword=mergeDice
Route::match(['get', 'post'], '/redirect', [ScoreController::class, 'redirect']);

// https://html5.b2mwap.com/bdgamers/MergeDice/?msisdn=01818401066&keyword=margeDice

// play.b2m-tech.com/api/score?msisdn=01818401066&score=407&keyword=mergeDice