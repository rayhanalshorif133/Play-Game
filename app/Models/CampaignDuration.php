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




    public function gameURL($gameID){
        $findGame = Game::find($gameID);
        // https://html5.b2mwap.com/bdgamers/MergeDice/?baseurl="http://ttalksdp.b2mwap.com"&msisdn=8801323174104&keyword=mergeDice

        $baseURL = url('');
        $url = '#';
        if($findGame){
            $msisdn = Auth::user()->msisdn;
            $url = $findGame->url . '?baseurl=' . $baseURL . '&msisdn=' . $msisdn . '&keyword=' . $findGame->keyword;
        }
        return $url;
    }
}
