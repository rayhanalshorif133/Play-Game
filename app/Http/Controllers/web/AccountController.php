<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\BkashPayment;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if(Auth::check()){
            $auth_user = Auth::user();
            $payments = BkashPayment::select()
                ->where('msisdn',Auth::user()->msisdn)
                ->where('status',1)
                ->with('campaign','campaignDuration','campaignDuration.game')
                ->get();
            return view('public.account.index', compact('auth_user','payments'));
        }else{
            return redirect()->route('public.login');
        }
    }

    // update 
    public function update(Request $request)
    {
        $method = $request->method();

        if($method == 'POST')
        {
        
            if($request->msisdn == null)
            {
               toastr()->addError('Please enter your phone number');
                return redirect()->back();
            }

           

            $auth_user = Auth::user();
            $auth_user->msisdn = $request->msisdn;
            $auth_user->name = $request->name;
            $auth_user->email = $request->email;
            $auth_user->save();

            setcookie("player_user", $auth_user, time() + (86400 * 1), "/");

            return redirect()->route('account.index');
        }

        $auth_user = Auth::user();
        return view('public.account.update', compact('auth_user'));
    }


    public function paymentHistory(){
        
        if(Auth::check()){
            $auth_user = Auth::user();
            if(!$auth_user->msisdn){
                return redirect()->route('account.update');
            }
            $bkashPayments = BkashPayment::select()
                ->where('msisdn',$auth_user->msisdn)
                ->with('campaign','campaignDuration')
                ->get();

            return view('public.account.payment-history',compact('bkashPayments'));
        }else{
            return redirect()->route('public.login');
        }
    }

}
