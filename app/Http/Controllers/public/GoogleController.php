<?php

namespace App\Http\Controllers\public;

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
            ->redirectUrl('http://127.0.0.1:8000/auth/google/callback')
            ->redirect();

    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();


            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){


                $finduser->google_avatar = $user->avatar;
                $finduser->save();
                Auth::login($finduser);
                return redirect()->intended('/user/dashboard');

            }else{
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->google_avatar = $user->avatar;
                $newUser->password = Hash::make($user->id);
                $newUser->role = 'user';
                $newUser->save();
                Auth::login($newUser);
                return redirect()->intended('/user/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
