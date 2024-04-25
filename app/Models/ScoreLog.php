<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'msisdn',
        'score',
        'game_keyword',
        'status',
        'url',
        'play_date',
        'play_time',
        'duration',
        'ip_address',
        'user_agent',
        'referrer',
        'device',
        'browser',
        'platform',
    ];
}
