<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function isLoginOrNot()
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login');
        }
    }

    public function index()
    {
        $this->middleware('auth');
        return view('admin.dashboard');
    }
}
