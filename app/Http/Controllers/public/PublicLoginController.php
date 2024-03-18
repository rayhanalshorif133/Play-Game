<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicLoginController extends Controller
{
    // login
    public function login()
    {
        return view('public.auth.login');
    }

    // logout
    public function logout()
    {
        dd('You have been logged out');
        Auth::logout();
        flash()->addSuccess('You have been logged out');
        dd('You have been logged out');
        return redirect()->route('home');
    }
}
