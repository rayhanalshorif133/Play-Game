<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'banner',
        'description',
        'keyword',
        'url',
        'status',

    ];

    public function URL($game, $msisdn){
        $payload = 'keyword=' . $game->keyword . '&token=' . $msisdn;
        $url = $game->url . '?' . $payload;
        return $url;
    }
}
