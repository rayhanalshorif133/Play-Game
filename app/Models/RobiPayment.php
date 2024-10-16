<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobiPayment extends Model
{
    use HasFactory;



    protected $fillable = [
        'msisdn',
        'aocTransID',
        'status',
        'amount',
        'chargeStatus',
        'transaction_id',
        'code',
        'response',
        'date_time',
    ];


}
