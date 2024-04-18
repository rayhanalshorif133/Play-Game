<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkashCreatePayment extends Model
{
    use HasFactory;

    protected $table = 'bkash_create_payments';

    protected $fillable = [
        'grent_token_id',
        'msisdn',
        'paymentID',
        'createTime',
        'orgLogo',
        'orgName',
        'transactionStatus',
        'amount',
        'currency',
        'intent',
        'merchantInvoiceNumber',
        'status',
        'message',
        'created_date',
        'created_time',
    ];
}
