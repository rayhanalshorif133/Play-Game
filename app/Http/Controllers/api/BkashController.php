<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GrentToken;


class BkashController extends Controller
{
    public function grentToken(Request $request)
    {

        $request_data = array(
            'app_key'		=>'2l6u3m4i01ed69foin29vp42m',
            'app_secret'	=>'1d2qur3hm323h26h6a0m5pqucka8qkaae5drfimo4vejabo032qi'
        );
        $header = array(
            'Content-Type:application/json',
            'username:BDGAMERS',
            'password:B@1PtexcaQMvb'
        );
        /* production */
        $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant');
        $request_data_json = json_encode($request_data);

        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($url);


        $response = json_decode($response, true);

        $grent_token = new GrentToken();
        $grent_token->id_token = $response['id_token'];
        $grent_token->token_type = $response['token_type'];
        $grent_token->expires_in = $response['expires_in'];
        $grent_token->refresh_token = $response['refresh_token'];
        $grent_token->created_date = date('Y-m-d');
        $grent_token->created_time = date('H:i:s');
        $grent_token->save();



        return response()->json([
            'message' => 'grent token',
            'response' => $response
        ]);
    }
}
