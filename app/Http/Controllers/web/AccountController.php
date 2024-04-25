<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $method = $request->method();

        if($method == 'POST')
        {
            dd($request->all());
        }

        $auth_user = Auth::user();
        return view('public.account.index', compact('auth_user'));
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
            $auth_user->save();

            return redirect()->route('account.index');
        }

        $auth_user = Auth::user();
        return view('public.account.update', compact('auth_user'));
    }


}
