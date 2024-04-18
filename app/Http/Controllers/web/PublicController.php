<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function dashboard()
    {
        $authUser = Auth::user();
        return view('public.dashboard', compact('authUser'));
    }

    // leaderboard
    public function leaderboard($id = null)
    {
        if ($id) {
            return view('public.leaderboard.show');
        }
        return view('public.leaderboard.index');
    }
}
