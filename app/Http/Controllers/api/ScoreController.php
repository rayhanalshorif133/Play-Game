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


        // Usage example
        // $dataToEncrypt = "120";
        // $key = "B2M";

        // $encryptedData = $this->encryptData($dataToEncrypt, $key);
        // if ($encryptedData !== false) {
        //     $dec = $this->decryptData($encryptedData, $key);
        //     dd("Encrypted data: " . $encryptedData . "\n" . 'Decrypted data: ' . $dec);
        // } else {
        //     dd("Encrypted failed: ");
        // }


        $msisdn = $request->msisdn;
        $get_score = $request->score;
        $game_keyword = $request->keyword;

        if ($msisdn == null || $get_score == null || $game_keyword == null) {
            return response()->json('Invalid Request');
        }



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
        // Decode the Base64 encoded data
        $encryptedData = base64_decode($encryptedData);

        // Extract IV from the encrypted data
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($encryptedData, 0, $ivSize);

        // Extract the encrypted data (excluding IV)
        $encryptedData = substr($encryptedData, $ivSize);

        // Decrypt the data using AES-256-CBC cipher and PKCS7 padding
        $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        if ($decryptedData === false) {
            // Handle decryption error
            return false;
        }

        return $decryptedData;
    }
}
