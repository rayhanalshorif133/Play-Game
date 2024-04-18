<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{
    // redirectToFacebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')
            ->redirectUrl('http://localhost:8000/auth/facebook/callback')
            ->redirect();
    }


    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();



            $finduser = User::where('email', $user->email)->first();

            if($finduser){
                $finduser->name = $user->name;
                $newUser->facebook_id = $user->id;
                $finduser->avatar = $user->avatar;
                $finduser->save();
                Auth::login($finduser);
            }else{
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->facebook_id = $user->id;
                $newUser->avatar = $user->avatar;
                $newUser->password = Hash::make($user->id);
                $newUser->role = 'user';
                $newUser->save();
                Auth::login($newUser);
            }
            return redirect()->intended('/user/dashboard');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
