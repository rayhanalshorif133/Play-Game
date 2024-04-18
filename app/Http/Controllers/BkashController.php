<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BkashController extends Controller
{
    // document
    public function document(){
        return view('bkash.document');
    }

    // payment
    public function createPayment(){
        return view('bkash.payment');
    }
}
