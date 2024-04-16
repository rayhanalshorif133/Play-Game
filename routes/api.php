<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CampaignScoreLogController;
use App\Http\Controllers\api\BkashController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/campaign-score-logs/create', [CampaignScoreLogController::class, 'create'])
    ->name('campaign-score-logs.create');


Route::controller(BkashController::class)
    ->prefix('bkash')
    ->name('bkash.')
    ->group(function(){
        Route::get('/grent-token','grentToken')->name('grent-token');
    });
