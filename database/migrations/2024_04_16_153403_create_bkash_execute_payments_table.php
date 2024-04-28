<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkashExecutePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkash_execute_payments', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn')->nullable();
            $table->string('bkash_msisdn')->nullable();
            $table->string('paymentID')->nullable();
            $table->string('createTime')->nullable();
            $table->string('updateTime')->nullable();
            $table->string('trxID')->nullable();
            $table->string('transaction_status')->nullable();
            $table->float('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('intent')->nullable();
            $table->string('merchantInvoiceNumber')->nullable();
            $table->dateTime('created_time')->nullable();
            $table->json('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bkash_execute_payments');
    }
}
