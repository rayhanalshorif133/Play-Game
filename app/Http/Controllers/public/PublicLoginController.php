<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PublicLoginController extends Controller
{
    // login
    public function login()
    {
        return view('public.auth.login');
    }


    // register
    public function register(Request $request)
    {
        try {
            $method = $request->method();
            if($method == "GET"){
                return view('public.auth.register');
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'msisdn' => 'required',
                    'password' => 'required|confirmed'
                ]);

                if ($validator->fails()) {
                    flash()->addError($validator->errors()->first());
                    return redirect()->back();
                }

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->msisdn = $request->msisdn;
                if($request->password){
                    if($request->password != $request->password_confirmation){
                        flash()->addError('Password and confirm password does not match');
                        return redirect()->back();
                    }
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                flash()->addSuccess('You have been successfully registered');
                return redirect()->route('user.login');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // profile
    public function profile(Request $request)
    {
        try {
            $method = $request->method();
            if($method == 'GET'){
                $user = Auth::user();
                return view('public.auth.profile', compact('user'));
            }else{

                $user = Auth::user();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->msisdn = $request->msisdn;

                if($request->password){
                    if($request->password != $request->password_confirmation){
                        flash()->addError('Password and confirm password does not match');
                        return redirect()->back();
                    }
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                flash()->addSuccess('Profile successfully updated');
                return redirect()->back();
            }

        } catch (\Throwable $th) {
            flash()->addError($th->getMessage());
            return redirect()->back();
        }
    }

    // logout
    public function logout()
    {
        dd('You have been logged out');
        Auth::logout();
        flash()->addSuccess('You have been logged out');
        dd('You have been logged out');
        return redirect()->route('home');
    }
}
