<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\BkashRefundController;
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

Route::get('/', function () {
    return view('bkash-payment');
});



// Payment Routes for bKash
Route::post('bkash/get-token', [BkashController::class,'getToken'])->name('bkash-get-token');
Route::post('bkash/create-payment', [BkashController::class,'createPayment'])->name('bkash-create-payment');
Route::post('bkash/execute-payment', [BkashController::class,'executePayment'])->name('bkash-execute-payment');
Route::get('bkash/query-payment', [BkashController::class,'queryPayment'])->name('bkash-query-payment');
Route::post('bkash/success', [BkashController::class,'bkashSuccess'])->name('bkash-success');

// Refund Routes for bKash
Route::get('bkash/refund', [BkashRefundController::class,'index'])->name('bkash-refund');
Route::post('bkash/refund', [BkashRefundController::class,'refund'])->name('bkash-refund');

