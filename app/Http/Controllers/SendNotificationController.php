<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SendNotificationController extends Controller
{
    // index
    public function index()
    {
        $users = User::select()->where('device_token', '!=', null)->get();
        return view('send-notification.index', compact('users'));
    }

    // sendNotification
    public function sendNotification(Request $request)
    {
        $title = $request->title;
        $message = $request->body;
        $user_id = $request->user_id;

        $firebaseToken = User::where('id', $user_id)->pluck('device_token')->toArray();

        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->back()->with('success', 'Notification sent successfully.');
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
