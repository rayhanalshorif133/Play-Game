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
        // return redirect()->route('home');
        $method = $request->getMethod();
        if($method == 'GET'){
            return view('public.auth.login');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required'
        ]);


        if ($validator->fails()) {
            Session::flash('error', 'There were validation errors. Please check your input.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // check if email or phone
        $phoneORemail = $request->email;
        $password = $request->password;

        $user = User::where('email', $phoneORemail)->first();

        if(!$user){
            Session::flash('error', 'User not found');
            return redirect()->back();
        }

        if(Hash::check($password, $user->password)){
            Auth::login($user);
            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');

        }else{
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
                    return redirect()->back();
                }


                $user = new User();
                $user->role = 'user';
                $user->msisdn = $request->msisdn;
                if($request->password){
                    if($request->password != $request->confirm_password){
                        return redirect()->back();
                    }
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                return redirect()->route('public.login');
            }
        } catch (\Throwable $th) {
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
                        return redirect()->back();
                    }
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                return redirect()->back();
            }

        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

}
