<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{

    // msisdn=8801323174104&keyword=mergeDice
    public function checkEligibleUser(Request $request)
    {


        $msisdn = $request->msisdn;
        $game_keyword = $request->keyword;

        if ($msisdn == null || $game_keyword == null) {
            return response()->json('Invalid Request');
        }

        $data = [
            'status' => true
        ];


        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        try {
            $findUser = User::select()->where('msisdn', $request->msisdn)->first();

            if (!$findUser) {
                return $this->respondWithError('User not found, please register again');
            }

            if (Hash::check($request->password, $findUser->password)) {

                setcookie("player_user", $findUser, time() + (86400 * 1), "/");
                return $this->respondWithSuccess('Successfully logged in');
               
                // After this line, the user is considered authenticated
            } else {
                return $this->respondWithError('Wrong password, please try again');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function register(Request $request)
    {
        try {

            $findUser = User::select()->where('msisdn', $request->msisdn)->first();

            if ($findUser) {
                return $this->respondWithError('User already registered');
            }

            if (substr($request->msisdn, 0, 2) !== '88') {
                $msisdn = '88' . $request->msisdn;
            }


            $user = new User();
            $user->name = $request->name;
            $user->msisdn = $msisdn;
            $user->password = Hash::make($request->password);
            $user->role = 'player';
            $user->status = 'active';
            $user->save();
            return $this->respondWithSuccess('Registration Success, Please login Now');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
