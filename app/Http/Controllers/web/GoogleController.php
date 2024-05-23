<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirectUrl('https://play.b2m-tech.com/auth/google/callback')
            ->redirect();

    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();


            $finduser = User::where('email', $user->email)->first();

            if($finduser){

                $finduser->avatar = $user->avatar;
                $finduser->save();
                Auth::login($finduser);
            }else{
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->avatar = $user->avatar;
                $newUser->password = Hash::make($user->id);
                $newUser->role = 'user';
                $newUser->save();
                Auth::login($newUser);
            }

            if(Auth::user()->role == 'user' && Auth::user()->msisdn == null){
                return redirect()->route('account.update');
            }
            flash()->addSuccess('You have been successfully login.');
            return redirect()->intended('/home');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
