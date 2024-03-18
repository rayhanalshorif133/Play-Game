<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;

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
            return redirect()->route('home');
        }
    }

    // home
    public function home()
    {
        $campaigns = Campaign::all();
        return view('public.home', compact('campaigns'));
    }

    public function index()
    {
        $this->middleware('auth');
        return view('admin.dashboard');
    }
}
