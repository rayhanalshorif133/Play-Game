<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;

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
    }
}
