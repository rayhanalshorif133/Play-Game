<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Game;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $this->middleware('auth');
        $campaigns = Campaign::select()->count();
        $games = Game::select()->count();
        return view('admin.dashboard',compact('campaigns','games'));
    }
}
