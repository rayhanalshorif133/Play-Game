<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Campaign;
use App\Models\Subscription;
use Carbon\Carbon;


class ScoreController extends Controller
{
    // score
    public function score(Request $request)
    {



        // https://gp.bdgamers.club/api/score?pengenal=WZg2HO8I784/3v/CF6K2yX4Bd82fcp56h+jN25jCOr0vpELtmWgzblxVBk/SnvVV&puntaje=MklWAU625P3Xstu4nTddZFkmQAoWwfW/xXOyc6/NQ88=
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


            $currentDate = Carbon::now()->toDateTimeString(); //

            $campaign = $this->getCurrentCampaign();

            $date = date('Y-m-d');

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
            if($subscription){
                $score->status = 1;
                $score->subscription_id = $subscription->id;
            }else{
                $score->status = 0;
            }
            $score->date_time = date('Y-m-d H:i:s');
            $score->save();





            // $ScoreLog = new ScoreLog();
            // $ScoreLog->msisdn = $msisdn;
            // $ScoreLog->score = $get_score;
            // $ScoreLog->game_keyword = $game_keyword;
            // $ScoreLog->status = 1;
            // $ScoreLog->url = $request->url;
            // $ScoreLog->play_time = date('H:i:s');
            // $ScoreLog->play_date = date('Y-m-d');
            // $ScoreLog->duration = $request->duration;
            // $ScoreLog->ip_address = 'localhost';
            // $ScoreLog->user_agent = $request->header('User-Agent');
            // $ScoreLog->referrer = $request->header('referer');
            // $ScoreLog->save();


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
