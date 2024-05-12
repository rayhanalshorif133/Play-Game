<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\ScoreLog;

class ScoreController extends Controller
{
    // score
    public function score(Request $request)
    {


        $msisdn = $request->msisdn;
        $get_score = $request->score;
        $game_keyword = $request->keyword;

        if ($msisdn == null || $get_score == null || $game_keyword == null) {
            return response()->json('Invalid Request');
        }

        $encryptedData = $get_score;
        $key = "18na21B2MDiceKad";
        $decryptedData = $this->decryptData($encryptedData, $key);

        if ($decryptedData === false) {
            return response()->json('Decryption failed..!' . openssl_error_string());
        }


        $numbers = preg_replace('/[^0-9]/', '', $decryptedData);
        $get_score = (int)$numbers;






        try {



            $score = Score::select('id')
                ->where('msisdn', $msisdn)
                ->where('game_keyword', $game_keyword)
                ->where('created_at', 'like' , '%'.date('Y-m-d').'%')
                ->first();
                
            if(!$score){
                $score = new Score();
            }else{
                if((float)$score->score > (float)$get_score){
                    $get_score = $score->score;
                }
            }
            $score->msisdn = $msisdn;
            $score->score = $get_score;
            $score->game_keyword = $game_keyword;
            $score->status = 1;
            $score->url = $request->url;
            $score->date_time = date('Y-m-d H:i:s');
            $score->duration = $request->duration;
            $score->ip_address = 'localhost';
            $score->user_agent = $request->header('User-Agent');
            $score->referrer = $request->header('referer');
            $score->save();




            $ScoreLog = new ScoreLog();
            $ScoreLog->msisdn = $msisdn;
            $ScoreLog->score = $get_score;
            $ScoreLog->game_keyword = $game_keyword;
            $ScoreLog->status = 1;
            $ScoreLog->url = $request->url;
            $ScoreLog->play_time = date('H:i:s');
            $ScoreLog->play_date = date('Y-m-d');
            $ScoreLog->duration = $request->duration;
            $ScoreLog->ip_address = 'localhost';
            $ScoreLog->user_agent = $request->header('User-Agent');
            $ScoreLog->referrer = $request->header('referer');
            $ScoreLog->save();
            return response()->json('Success');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }


    function encryptData($data, $key)
{
    // Generate a random IV (Initialization Vector)
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivSize);

    // Encrypt the data using AES-256-CBC cipher and PKCS7 padding
    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

    if ($encryptedData === false) {
        // Handle encryption error
        return false;
    }

    // Combine IV and encrypted data
    $result = $iv . $encryptedData;

    // Encode the result in Base64 for transport/storage
    $result = base64_encode($result);

    return $result;
}




function decryptData($encryptedData, $key)
{
    // Decode the encrypted data from base64
    $encryptedData = base64_decode($encryptedData);

    // Ensure the key size is valid
    $key = substr($key, 0, 16); // Truncate to 16 bytes for 128-bit key

    // Set encryption parameters
    $method = 'aes-128-ecb'; // AES encryption with ECB mode and 128-bit key length

    // Perform decryption
    $decryptedData = openssl_decrypt($encryptedData, $method, $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);

    if ($decryptedData === false) {
        die('Decryption failed: ' . openssl_error_string());
    }

    return $decryptedData;
}
}
