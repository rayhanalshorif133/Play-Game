<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bkash_create_payments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('grent_token_id')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('paymentID')->nullable();
            $table->string('createTime')->nullable();
            $table->string('orgLogo')->nullable();
            $table->string('orgName')->nullable();
            $table->string('transactionStatus')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('intent')->nullable();
            $table->string('merchantInvoiceNumber')->nullable();
            $table->string('status')->nullable();
            $table->date('created_date')->nullable();
            $table->time('created_time')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_create_payments');
    }
};
