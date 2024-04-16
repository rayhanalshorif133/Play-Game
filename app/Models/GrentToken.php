<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrentToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_token',
        'token_type',
        'expires_in',
        'refresh_token',
        'created_date',
        'created_time',
    ];
}
