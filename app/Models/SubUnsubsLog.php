<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUnsubsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'robi_payment_id',
        'message',
        'msisdn',
        'type',
        'keyword',
        'status',
        'date_time',
    ];


    protected $casts = [
        'date_time' => 'datetime',
    ];
}
