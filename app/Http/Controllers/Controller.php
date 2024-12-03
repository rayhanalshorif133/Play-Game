<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function __construct(){
        $this->handleMsisdn();
    }


         // For API
    protected function respondWithSuccess($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'status'   => true,
            'errors'  => false,
            'message'  => $message,
            'data'     => $data
        ], $code);
    }
    protected function respondWithError($message, $data = [], $code = 203)
    {
        return response()->json([
            'status'   => false,
            'errors'  => true,
            'message'  => $message,
            'data'     => $data
        ], $code);
    }

    protected function getRandomBadge()
    {
        $badges = [
            "primary",
            "secondary",
            "success",
            "danger",
            "warning",
            "info",
        ];
        return $badges[rand(0, count($badges) - 1)];
    }


    protected function handleMsisdn()
    {
        $msisdn = "";
        if (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID'])) {
            $msisdn = trim($_SERVER['HTTP_X_UP_CALLING_LINE_ID']);
        } else if (isset($_SERVER['HTTP_X_HTS_CLID'])) {
            $msisdn = trim($_SERVER['HTTP_X_HTS_CLID']);
        } else if (isset($_SERVER['HTTP_MSISDN'])) {
            $msisdn = trim($_SERVER['HTTP_MSISDN']);
        } else if (isset($_COOKIE['User-Identity-Forward-msisdn'])) {
            $msisdn = $_COOKIE['User-Identity-Forward-msisdn'];
        } else if (isset($_SERVER["HTTP_X_MSISDN"])) {
            $msisdn = $_SERVER["HTTP_X_MSISDN"];
        }

        setcookie('msisdn', $msisdn, time() + (86400 * 30), "/"); // 86400 = 1 day
    }

    public function get_msisdn()
    {

        if (isset($_COOKIE["player_user"])) {
            $user = $_COOKIE["player_user"];
            $user = json_decode($user, true);
            return $user['msisdn'];
        }else {
            return "";
        }
    }
    
    public function get_channel()
    {

        if (isset($_COOKIE["channel"])) {
            $channel = $_COOKIE["channel"];
            return $channel;
        }else {
            // false, cookie is not set
            return "";
        }
    }

    public function getCurrentCampaign(){
        $date = date('Y-m-d');
        $campaign = Campaign::where('status', 1)
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->first();
        return $campaign;
    }
}
