<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'campaign_duration_id',
        'question_id',
        'answer',
        'type',
        'time_taken',
        'score'
    ];
}
