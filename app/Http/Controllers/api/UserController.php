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



            $msisdn = $request->msisdn;
            
            if (substr($request->msisdn, 0, 2) !== '88') {
                $msisdn = '88' . $request->msisdn;
            }

            $findUser = User::where('msisdn', 'LIKE', '%' . $msisdn . '%')->first();

            if (!$findUser) {
                return $this->respondWithError('User not found, please register again');
            }

            if ($findUser->status == 0) {
                return $this->respondWithError('User is inactive, please contact the administrator');
            }

            setcookie("player_user", "", time() - (86400 * 1), "/");

            if (Hash::check($request->password, $findUser->password)) {
                setcookie("player_user", $findUser, time() + (86400 * 1), "/");
                return $this->respondWithSuccess('Successfully logged in');                
            } else {
                return $this->respondWithError('Wrong password, please try again');
            }
        } catch (\Throwable $th) {
            return $this->respondWithError('Something went wrong, please contact the administrator');
        }
    }

    public function register(Request $request)
    {
        try {

            $msisdn = $request->msisdn;
            if (substr($request->msisdn, 0, 2) !== '88') {
                $msisdn = '88' . $request->msisdn;
            }

            $findUser = User::where('msisdn', 'LIKE', '%' . $msisdn . '%')->first();


            if ($findUser) {
                return $this->respondWithError('User already registered');
            }




            $user = new User();
            $user->name = $request->name;
            $user->msisdn = $msisdn;
            $user->password = Hash::make($request->password);
            $user->role = 'player';
            $user->status = 1;
            $user->save();
            return $this->respondWithSuccess('Registration Success, Please login Now');
        } catch (\Throwable $th) {
            return $this->respondWithError($th->getMessage());
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $msisdn = $request->msisdn;
            if (substr($request->msisdn, 0, 2) !== '88') {
                $msisdn = '88' . $request->msisdn;
            }
            $findUser = User::where('msisdn', 'LIKE', '%' . $msisdn . '%')->first();
            if ($findUser) {
                $findUser->password = Hash::make($request->pass);
                $findUser->save();
                return $this->respondWithSuccess('Password successfully updated, Please login Now');
            } else {
                return $this->respondWithError('User not found');
            }
        } catch (\Throwable $th) {
            return $this->respondWithError($th->getMessage());
        }
    }
}
