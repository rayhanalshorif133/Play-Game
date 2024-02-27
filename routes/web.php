<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;



Route::get('/', [HomeController::class, 'isLoginOrNot']);

Auth::routes();

Route::middleware('auth')->get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)
    ->middleware('auth')
    ->prefix('user')
    ->name('user.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/fetch/{id}', 'fetchUser')->name('edit');
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
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
});
