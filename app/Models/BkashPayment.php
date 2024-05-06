<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkashPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'msisdn',
        'bkash_msisdn',
        'bkash_execute_payment_id',
        'campaign_id',
        'tournament_id',
        'campaign_duration_id',
        'amount',
        'paymentID',
        'status',
        'date_time',
        'end_date_time',
        'message',  
    ];


    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
    public function campaignDuration()
    {
        return $this->belongsTo(CampaignDuration::class,'campaign_duration_id');
    }
    


}
