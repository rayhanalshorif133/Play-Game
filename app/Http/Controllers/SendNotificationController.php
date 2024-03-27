<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SendNotificationController extends Controller
{
    // index
    public function index()
    {
        return view('send-notification.index');
    }

    // save-auth-user-token
    public function saveAuthUserToken(Request $request)
    {

        $token = $request->token;
        $user_id = $request->user_id;
        if(!$token || !$user_id){
            return response()->json([
                'message' => 'Token or user_id is missing'
            ]);
        }

        $user = User::find($user_id);
        if($user){
            $user->device_token = $token;
            $user->save();
            return response()->json([
                'message' => 'Token saved successfully'
            ]);
        }

    }
}
