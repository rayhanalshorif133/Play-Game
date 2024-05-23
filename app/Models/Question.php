<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'created_by',
        'updated_by',
        'title',
        'description',
        'image',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'score',
        'status',
    ];


    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
