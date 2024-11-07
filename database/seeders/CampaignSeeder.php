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


        for ($i = 0; $i < 3; $i++) {

            $campaign = new Campaign();
            $campaign->name = 'Title of camp' . $i;
            $campaign->amount = 1;
            $campaign->start_date_time = Carbon::now()->subDay(2);
            $campaign->end_date_time = Carbon::now()->addDay(2);
            $campaign->status = 0;
            $campaign->description = 'Test campaign';
            $campaign->created_by = 1;
            $campaign->updated_by = null;
            $campaign->save();
        }

        $campaign = new Campaign();
            $campaign->name = 'Title of camp' . 4;
            $campaign->amount = 1;
            $campaign->start_date_time = Carbon::now()->subDay(2);
            $campaign->end_date_time = Carbon::now()->addDay(2);
            $campaign->status = 1;
            $campaign->description = 'Test campaign';
            $campaign->created_by = 1;
            $campaign->updated_by = null;
            $campaign->save();


        $game = new Game();
        $game->title = 'Snake';
        $game->banner = '/images/game/1714378425_images.jpg';
        $game->description = 'Snake';
        $game->keyword = 'snake';
        $game->url = 'https://gp.bdgamers.club/public/snake-game/';
        $game->status = '1';
        $game->save();
    }
}
