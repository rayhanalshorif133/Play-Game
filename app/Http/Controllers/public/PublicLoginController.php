<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicLoginController extends Controller
{
    // login
    public function login()
    {
        return view('public.auth.login');
    }
}
