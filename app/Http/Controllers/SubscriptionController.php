<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Subscription;



class SubscriptionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Subscription::all();
             return DataTables::of($query)
             ->addIndexColumn()
             ->toJson();
        }
        return view('subscription.index');
    }
}
