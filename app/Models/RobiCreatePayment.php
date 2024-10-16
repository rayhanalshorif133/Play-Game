<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobiCreatePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'aocTransID',
        'redirectURL',
        'spTransID',
        'response',
        'date_time'
    ];
}
