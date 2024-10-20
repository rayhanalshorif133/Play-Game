<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class CampaignDuration extends Model
{
    use HasFactory;

    protected $table = 'campaign_durations';

    protected $fillable = [
        'name',
        'amount',
        'play_type',
        'campaign_id',
        'start_date_time',
        'end_date_time',
        'game_id',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }




    public function gameURL($campaignDuration){
        $findGame = Game::find($campaignDuration->game_id);
        $url = $findGame->url . '?keyword=' . $findGame->keyword . '&token=' . $this->get_msisdn();
        return $url;
    }

    public function calculateDuration($campaignDuration)
    {
        $cuttentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $start = strtotime($cuttentDate . ' ' . $currentTime);
        $end = strtotime($campaignDuration->end_date_time);
        $diff = $end - $start;
        $days = floor($diff / (60 * 60 * 24));
        $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        // return $days . 'd ' . $hours . 'h ' . $minutes . 'm';
        return $days . 'd ' . $hours . 'h ';
    }
}
