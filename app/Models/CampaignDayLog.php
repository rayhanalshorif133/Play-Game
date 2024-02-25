<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDayLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'campaign_duration_id',
        'date',
        'total_score',
        'total_time_taken'
    ];
}
