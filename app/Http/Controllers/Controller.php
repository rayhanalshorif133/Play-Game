<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

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
        if (isset($_COOKIE['msisdn'])) {
            // true, cookie is set
            return $_COOKIE['msisdn'];
        } else {
            // false, cookie is not set
            return "";
        }
    }
}
