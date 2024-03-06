<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignDurationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CampaignScoreLogController;



Route::get('/', [HomeController::class, 'isLoginOrNot']);

Auth::routes();

Route::middleware('auth')->get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)
    ->middleware('auth')
    ->prefix('user')
    ->name('user.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/fetch/{id}', 'fetchUser')->name('fetch-user');
    Route::put('/update', 'update')->name('update');
    Route::delete('/{id}', 'delete')->name('delete');
});

// campaign
Route::controller(CampaignController::class)
    ->middleware('auth')
    ->prefix('campaigns')
    ->name('campaigns.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/fetch/{id}', 'fetchCampaign')->name('fetch-campaign');
    Route::get('/create', 'create')->name('create');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::put('/update/{id}', 'update')->name('update');
    Route::delete('/{id}', 'delete')->name('delete');
});

// campaign_durations
Route::controller(CampaignDurationController::class)
    ->middleware('auth')
    ->prefix('campaign-durations')
    ->name('campaign-durations.')
    ->group(function () {
    Route::get('/{campaign_id}', 'index')->name('index');
    Route::get('/fetch/{id}', 'fetch')->name('fetch');
    Route::post('/store', 'store')->name('store');
    Route::put('/update', 'update')->name('update');
    Route::delete('/{id}', 'delete')->name('delete');
});
// campaign_score_logs
Route::controller(CampaignScoreLogController::class)
    ->middleware('auth')
    ->prefix('campaign-score-logs')
    ->name('campaign-score-logs.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
});


// Question
Route::controller(QuestionController::class)
    ->middleware('auth')
    ->prefix('questions')
    ->name('questions.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/update', 'update')->name('update');
    // Route::delete('/{id}', 'delete')->name('delete');
});
