<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'start_date_time',
        'end_date_time',
        'status',
        'description',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function campaignDuration()
    {
        return $this->hasMany(CampaignDuration::class);
    }

    public function gameURL($msisdn)
    {
        $game = Game::select()->first();
        $payload = 'keyword=' . $game->keyword . '&token=' . $msisdn;
        $url = $game->url . '?payload=' . $payload;
        return $url;
    }
}
