<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentStatus($status){
        if($status == 'failed'){
            return view('public.payment.failed');
        }
        return view('public.payment.success');
    }
}
