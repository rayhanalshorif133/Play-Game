<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkashExecutePayment extends Model
{
    use HasFactory;

    protected $table = 'bkash_execute_payments';

    protected $fillable = [
        'msisdn',
        'bkash_msisdn',
        'paymentID',
        'createTime',
        'updateTime',
        'trxID',
        'transaction_status',
        'amount',
        'amount',
        'currency',
        'intent',
        'merchantInvoiceNumber',
        'created_time',
        'response',
    ];

}
