<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // index
    public function index()
    {
        return view('questions.index');
    }
}
