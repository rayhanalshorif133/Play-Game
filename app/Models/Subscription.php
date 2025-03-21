<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'msisdn',
        'acr',
        'campaign_id',
        'keyword',
        'status',
        'subs_date',
        'unsubs_date',
    ];
}
