<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignScoreLog;
use App\Models\CampaignDuration;
use App\Models\Campaign;
use App\Models\Question;

class CampaignScoreLogController extends Controller
{
    public function create(Request $request)
    {
        try {


            $campaign_id = CampaignDuration::select('campaign_id')->where('id', $request->campaign_duration_id)->first();

            if (!$campaign_id) {
                return $this->respondWithError('Campaign Duration not found');
            }

            $question = Question::select()
                ->where('id', $request->question_id)
                ->where('campaign_id', $campaign_id)
                ->first();

            if (!$question) {
                $data = [
                    'question_id' => (int)$request->question_id,
                    'campaign_id' => $campaign_id->campaign_id
                ];
                return $this->respondWithError('Question not found',$data);
            }
            // find campaign
            $campaign = Campaign::find($campaign_id);
            if(!$campaign){
                return $this->respondWithError('Campaign not found');
            }

            return $this->respondWithSuccess('question', $question);


            if ($question->correct_option == $request->answer) {
                $score = $question->score;
                $type = 'right';
            } else {
                $score = 0;
                $type = 'wrong';
            }
            $campaignScoreLog = new CampaignScoreLog();
            $campaignScoreLog->campaign_id = $campaign_id;
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
