<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    if(Auth::check()){
        return redirect()->route('home');
    }else{
        // return view('welcome');
        return redirect()->route('login');
    }
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

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
