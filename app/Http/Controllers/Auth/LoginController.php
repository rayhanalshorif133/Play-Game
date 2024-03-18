<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';




    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        $user = User::select()->where('email', $request->email)->first();

        if(!$user){
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        if($user && $user->status == 'inactive'){
            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact the administrator.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            if($user->role == 'super-admin' || $user->role == 'admin'){
                return redirect()->intended('admin/dashboard');
            }else{
                return redirect()->intended('user/dashboard');

            }
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
