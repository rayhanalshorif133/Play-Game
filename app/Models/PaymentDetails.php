<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    use HasFactory;


    protected $fillable = [
        'keyword',
        'msisdn',
        'type',
        'status',
        'acr',
        'result',
        'response',
        'date_time'
    ];
}
