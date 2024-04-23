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
            $this->middleware('auth');
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
        }
        return redirect()->route('home');
    }

    // admin
    public function admin()
    {
        $this->middleware('auth');
        return redirect()->route('admin.dashboard');
    }

    // home
    public function home()
    {

        $campaigns = Campaign::select()
            ->where('status', 1)
            ->with('campaignDuration')
            ->get();
        return view('public.home', compact('campaigns'));
    }

    public function index()
    {
        $this->middleware('auth');
        return view('admin.dashboard');
    }
}
