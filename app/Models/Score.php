<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;


    protected $fillable = [
        'msisdn',
        'score',
        'game_keyword',
        'status',
        'url',
        'play_time',
        'end_time',
        'duration',
        'ip_address',
        'user_agent',
        'referrer',
        'device',
        'browser',
        'platform',
    ];
}
