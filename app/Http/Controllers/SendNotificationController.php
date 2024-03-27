<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendNotificationController extends Controller
{
    // index
    public function index()
    {
        return view('send-notification.index');
    }
}
