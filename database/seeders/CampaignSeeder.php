<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\Game;
use App\Models\CampaignDuration;
use Carbon\Carbon;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $campaign = new Campaign();
        $campaign->title = 'Islamic Quiz';
        $campaign->type = 'quiz';
        $campaign->per_q_time_limit = 10;
        $campaign->total_time_limit = 60;
        $campaign->total_questions = 10;
        $campaign->per_question_score = 10;
        $campaign->status = 1;
        $campaign->description = 'This is a Islamic Quiz campaign';
        $campaign->created_by = 1;
        $campaign->updated_by = 1;
        $campaign->save();


        $game = new Game();
        $game->title = 'Marge Dice';
        $game->banner = '/images/game/1714378425_images.jpg';
        $game->description = 'Marge Dice';
        $game->keyword = 'margeDice';
        $game->url = 'https://html5.b2mwap.com/bdgamers/MergeDice/';
        $game->status = '0';
        $game->save();




        $campDuration = new CampaignDuration();
        $campDuration->name = '1st';
        $campDuration->amount = 1;
        $campDuration->campaign_id = 1;
        $campDuration->start_date_time = Carbon::now()->subDay(2);
        $campDuration->end_date_time = Carbon::now()->addDay(2);
        $campDuration->status = '1';
        $campDuration->game_id = $game->id;
        $campDuration->save();

    }
}
