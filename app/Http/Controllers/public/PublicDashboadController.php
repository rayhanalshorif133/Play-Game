<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicDashboadController extends Controller
{
    public function dashboard()
    {
        return view('public.dashboard');
    }
}
