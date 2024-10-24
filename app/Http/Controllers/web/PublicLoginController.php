<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class PublicLoginController extends Controller
{
    // login
    public function login(Request $request)
    {
        return redirect()->route('home');
        $method = $request->getMethod();
        if($method == 'GET'){
            return view('public.auth.login');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email_phone' => 'required'
        ]);

        if($validator->fails()){
            flash()->addError('Email or Phone Number and Password is required');
            return redirect()->back();
        }

        // check if email or phone
        $phoneORemail = $request->email_phone;
        $password = $request->password;

        $user = User::where('email', $phoneORemail)->orWhere('msisdn', $phoneORemail)->first();

        if(!$user){
            flash()->addError('User not found');
            return redirect()->back();
        }

        if(Hash::check($password, $user->password)){
            Auth::login($user);
            flash()->addSuccess('You have been successfully logged in');
            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');

        }else{
            flash()->addError('Invalid email/phone or password');
            return redirect()->back();
        }

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
                    'msisdn' => 'required',
                ]);



                if ($validator->fails()) {
                    flash()->addError($validator->errors()->first());
                    return redirect()->back();
                }


                $user = new User();
                $user->role = 'user';
                $user->msisdn = $request->msisdn;
                if($request->password){
                    if($request->password != $request->confirm_password){
                        flash()->addError('Password and confirm password does not match');
                        return redirect()->back();
                    }
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                flash()->addSuccess('You have been successfully registered');
                return redirect()->route('public.login');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            flash()->addError($th->getMessage());
            return redirect()->back();
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

}
