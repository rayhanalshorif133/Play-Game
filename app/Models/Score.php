<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;


    protected $fillable = [
        'campaign_id',
        'subscription_id',
        'msisdn',
        'score',
        'game_keyword',
        'status',
        'date_time',
    ];
}
