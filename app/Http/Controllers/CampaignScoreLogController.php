<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Question;

class CampaignScoreLogController extends Controller
{
    // index
    public function index()
    {
        if (request()->ajax()) {
            $query = Question::orderBy('created_at', 'desc')
                ->with('createdBy')
                ->get();
             return DataTables::of($query)
             ->addIndexColumn()
             ->rawColumns(['action'])
             ->toJson();
        }
        return view('campaign_score_logs.index');
    }

    /*
    'campaign_id',
    'campaign_duration_id',
    'question_id',
    'answer',
    'type',
    'time_taken',
    'score'
    */
}
