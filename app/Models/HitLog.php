<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitLog extends Model
{
    use HasFactory;


    protected $table = 'hit_logs'; // Table name

    protected $fillable = [
        'ip_address',
        'query_string',
        'user_agent',
        'additional_info',
        'date',
        'time',
    ];


    
}
