<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Campaign;
use App\Models\Game;
use App\Models\Subscription;
use Carbon\Carbon;
use App\Models\User;

class PublicController extends Controller
{

    public function dashboard()
    {
        $authUser = Auth::user();
        return view('public.dashboard', compact('authUser'));
    }


    // description
    public function campaignDetails($id)
    {
        $currentDate = Carbon::now()->toDateTimeString();
        $campaign = Campaign::select()->where('id', $id)->first();
        $game = Game::select()->first();

        $msisdn = $this->get_msisdn();


        return view('public.description', compact('game', 'campaign', 'currentDate', 'msisdn'));
    }

    public function playerProfile(Request $request)
    {
        $msisdn = '';
        $user = '';

        if ($request->method() == 'PUT') {

            if(!$request->name){
                Session::flash('error', 'Name is required');
                return redirect()->back();
            }

            $user = User::find($request->user_id); 
            $user->name = $request->name;
            // $user->msisdn = $msisdn;
            $user->password = Hash::make($request->password);
            $user->save();
            setcookie("player_user", $user, time() + (86400 * 1), "/");
            Session::flash('success', 'User Profile successfully updated!');
            return redirect()->back();
        } else {
            if (isset($_COOKIE["player_user"])) {
                $user = $_COOKIE["player_user"];
                $user = json_decode($user, true);
                $user = User::where('msisdn', '=',  $user['msisdn'])->where('status', 1)->first();
                if ($user) {
                    $isSubs = Subscription::where('msisdn', '=',  $user->msisdn)
                        ->where('status', '=', 1)
                        ->first();
                    if ($isSubs) {
                        $hasAlreadySubs = true;
                    }
                } else {
                    setcookie("player_user", "", time() - (86400 * 1), "/");
                }
            }
            return view('public.playerProfile', compact('user'));
        }
    }

    public function checkGPNumber($number)
    {
        // Regex to match GP numbers
        $firstFiveDigits = substr($number, 0, 5);
        if($firstFiveDigits == '88013' || $firstFiveDigits == '88017'){
            return true;
        }else{
            return false;
        }
    }
}
