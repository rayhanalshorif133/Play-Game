<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'campaign_id',
        'start_date',
        'end_date',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
