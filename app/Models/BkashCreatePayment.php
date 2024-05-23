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
        'campaign_duration_id',
        'msisdn',
        'paymentID',
        'orgLogo',
        'orgName',
        'transactionStatus',
        'amount',
        'currency',
        'intent',
        'merchantInvoiceNumber',
        'status',
        'message',
        'hash',
        'response',
        'createDateTime',
    ];
}
