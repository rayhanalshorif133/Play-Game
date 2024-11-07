<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CampaignScoreLogController;
use App\Http\Controllers\SendNotificationController;
use App\Http\Controllers\web\PublicController;
use App\Http\Controllers\web\PublicLoginController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\web\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    return 'Clear';
});

Route::get('/', [HomeController::class, 'isLoginOrNot']);
Route::get('/admin', [HomeController::class, 'admin']);

Auth::routes();



Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/campaign-details/{campaign_id}', [PublicController::class, 'campaignDetails'])->name('campaign.campaign-details');
Route::get('/player-profile', [PublicController::class, 'playerProfile'])->name('player-profile');


Route::middleware('auth')
    ->prefix('account')
    ->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::match(['get', 'post'], '/update', [AccountController::class, 'update'])->name('update');
        Route::get('/payment-history', [AccountController::class, 'paymentHistory'])->name('payment-history');
    });



Route::prefix('admin')
    ->middleware('auth', 'role')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::prefix('user')
            ->name('user.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/fetch/{id}', [UserController::class, 'fetchUser'])->name('fetch-user');
                Route::put('/update', [UserController::class, 'update'])->name('update');
                Route::delete('/{id}', [UserController::class, 'delete'])->name('delete');
            });

        // campaign
        Route::match(['get', 'put', 'post', 'delete'], '/campaigns', [CampaignController::class, 'index'])->name('campaigns');
        Route::match(['get'], '/subscribers', [SubscriptionController::class, 'index'])->name('subscribers');


        // campaign_durations

        // campaign_score_logs
        Route::middleware('auth')->get('campaign-score-logs/', [CampaignScoreLogController::class, 'index'])->name('campaign-score-logs.index');
        Route::middleware('auth')->get('score-logs/', [CampaignScoreLogController::class, 'scoreLogs'])->name('score-logs.index');

        // Question
        Route::middleware('auth')
            ->prefix('questions')
            ->name('questions.')
            ->group(function () {
                Route::get('/', [QuestionController::class, 'index'])->name('index');
                Route::get('/create', [QuestionController::class, 'create'])->name('create');
                Route::get('/{id}/fetch', [QuestionController::class, 'fetch'])->name('fetch');
                Route::post('/store', [QuestionController::class, 'store'])->name('store');
                Route::post('/upload', [QuestionController::class, 'upload'])->name('upload');
                Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('edit');
                Route::post('/update', [QuestionController::class, 'update'])->name('update');
                Route::delete('/{id}', [QuestionController::class, 'delete'])->name('delete');
            });

        // Game
        Route::prefix('games')
            ->name('games.')
            ->group(function () {
                Route::get('/', [GameController::class, 'index'])->name('index');
                Route::get('/{id}/fetch', [GameController::class, 'fetch'])->name('fetch');
                Route::post('/store', [GameController::class, 'store'])->name('store');
                Route::put('/update', [GameController::class, 'update'])->name('update');
                Route::delete('/{id}', [GameController::class, 'delete'])->name('delete');
            });

        // SendNotificationController
        Route::prefix('send-notification')
            ->name('send-notification.')
            ->group(function () {
                Route::get('/', [SendNotificationController::class, 'index'])->name('index');
                Route::post('/user', [SendNotificationController::class, 'sendNotification'])->name('portal');
            });
    });



Route::name('public.')
    ->group(function () {
        Route::middleware('guest')->match(['get', 'post'], '/login', [PublicLoginController::class, 'login'])->name('login');
        Route::middleware('guest')->match(['get', 'post'], '/register', [PublicLoginController::class, 'register'])->name('register');
        Route::middleware('auth')->get('/logout', [PublicLoginController::class, 'logout'])->name('logout');
        Route::middleware('auth')->match(['get', 'put'], '/profile', [PublicLoginController::class, 'profile'])->name('user.profile');
    });




// // public user dashboard routes
Route::middleware('auth')->get('/user/dashboard', [PublicController::class, 'dashboard'])->name('public.user.dashboard');

// // send notification
Route::middleware('auth')->put('/save-auth-user-token', [SendNotificationController::class, 'saveAuthUserToken'])->name('save-auth-user-token');


// // Public routes
Route::get('/leaderboard/{id?}', [PublicController::class, 'leaderboard'])->name('public.leaderboard');



// Payment Routes for Robi
