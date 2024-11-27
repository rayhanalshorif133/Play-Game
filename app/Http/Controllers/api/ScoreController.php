<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Subscription;
use Carbon\Carbon;


class ScoreController extends Controller
{
    // score
    function getCurrentUrl() {
        // Check if HTTPS is used
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) 
                    ? "https://" 
                    : "http://";
    
        // Construct the full URL
        $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
        return $currentUrl;
    }
    public function score(Request $request)
    {



        $pengenal = $request->pengenal;
        $puntaje = $request->puntaje;


        if ($pengenal == null || $puntaje == null) {
            return response()->json('Invalid Request, required pengenal and puntaje');
        }

        $key = "B2M_T3chN0l0g!@$";
        $modifiedString = str_replace(' ', '+', $pengenal);
        $modifiedStringPuntaje = str_replace(' ', '+', $puntaje);
        $pengenals = $this->decrypt($modifiedString, $key);
        $parts = explode('_', $pengenals);
        $game_keyword = $parts[1] ?? "0";
        $msisdn = $parts[0] ?? "0";
        $get_score = $this->decrypt($modifiedStringPuntaje, $key);


        try {



            $campaign = $this->getCurrentCampaign();

            $date = date('Y-m-d');
            $time = date('H:i:s');


            $isInactiveUser = User::select()->where('msisdn', '=',  $msisdn)->where('status', '=', 0)->first();
            if($isInactiveUser){
                return response()->json('Inactive User');
            }

            $subscription = Subscription::where('msisdn', '=',  $msisdn)
            ->where('campaign_id','=', $campaign->id)
            ->where('status', '=', 1)
            ->whereDate('subs_date', $date)
            ->first();


           


            $score = new Score();
            $score->msisdn = $msisdn;
            $score->campaign_id = $campaign->id;
            $score->score = $get_score;
            $score->game_keyword = $game_keyword;
            if($subscription && $time >= '10:00:00' && $time <= '23:59:59'){
                $score->status = 1;
                $score->subscription_id = $subscription->id;
            }else{
                $score->status = 0;
            }
            $score->date_time = date('Y-m-d H:i:s');
            $score->hit_url = $this->getCurrentUrl();
            $score->save();


            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }



    public function decrypt($encryptedText, $encryptionKey)
    {
        // Decode the base64 encoded string
        $fullCipher = base64_decode($encryptedText);

        if (strlen($fullCipher) < 16) {
            // If the cipher is too short, something went wrong
            error_log("Encrypted text length is too short. Decryption failed.");
            return null;
        }

        // Extract the IV and the encrypted bytes
        $iv = substr($fullCipher, 0, 16);  // The first 16 bytes are the IV
        $encryptedBytes = substr($fullCipher, 16);  // The rest is the encrypted data

        // Decrypt the data
        $decryptedBytes = openssl_decrypt($encryptedBytes, 'aes-128-cbc', $encryptionKey, OPENSSL_RAW_DATA, $iv);

        if ($decryptedBytes === false) {
            error_log("Error during decryption: " . openssl_error_string());
            return null;
        }
        return $decryptedBytes;
    }
}
