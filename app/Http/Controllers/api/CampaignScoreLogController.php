<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignScoreLog;
use App\Models\Question;

class CampaignScoreLogController extends Controller
{
    public function create(Request $request)
    {
        try {

            $question = Question::find($request->question_id);
            if ($question->correct_option == $request->answer) {
                $score = $question->score;
                $type = 'right';
            } else {
                $score = 0;
                $type = 'wrong';
            }
            $campaignScoreLog = new CampaignScoreLog();
            $campaignScoreLog->campaign_id = $request->campaign_id;
            $campaignScoreLog->campaign_duration_id = $request->campaign_duration_id;
            $campaignScoreLog->question_id = $request->question_id;
            $campaignScoreLog->answer = $request->answer;
            $campaignScoreLog->type = $type;
            $campaignScoreLog->time_taken = $request->time_taken;
            $campaignScoreLog->score = $score;
            $campaignScoreLog->save();

            return $this->respondWithSuccess('Campaign Score Logs', $campaignScoreLog);

        } catch (\Throwable $th) {
            return $this->respondWithError($th->getMessage());
        }
    }
}
