<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CampaignDurationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CampaignScoreLogController;
use App\Http\Controllers\public\PublicLoginController;
use App\Http\Controllers\public\GoogleController;
use App\Http\Controllers\public\PublicDashboadController;



Route::get('/', [HomeController::class, 'isLoginOrNot']);

Auth::routes();


Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::post('user/login', [LoginController::class, 'login'])->name('user.login');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::controller(UserController::class)
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
        Route::get('/{id}/fetch', 'fetch')->name('fetch');
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
        Route::get('/{id}/fetch', 'fetch')->name('fetch');
        Route::post('/store', 'store')->name('store');
        Route::post('/upload', 'upload')->name('upload');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::delete('/{id}', 'delete')->name('delete');
    });
});

Route::controller(PublicLoginController::class)
    ->middleware('guest')
    ->name('public.')
    ->group(function () {
        // http://127.0.0.1:8000/auth/google/callback
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'register')->name('register');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });

Route::controller(GoogleController::class)->group(function(){
    Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback')->name('auth.google.callback');
});

// public user dashboard routes
Route::get('/user/dashboard', [PublicDashboadController::class, 'dashboard'])->name('public.user.dashboard');




