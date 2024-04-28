<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDuration extends Model
{
    use HasFactory;

    protected $table = 'campaign_durations';

    protected $fillable = [
        'name',
        'amount',
        'campaign_id',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
