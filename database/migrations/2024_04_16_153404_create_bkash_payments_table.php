<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkashPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkash_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('msisdn')->nullable();
            $table->string('bkash_msisdn')->nullable();
            $table->string('paymentID')->nullable();
            $table->bigInteger('bkash_execute_payment_id')->unsigned();
            $table->bigInteger('campaign_id')->unsigned()->nullable();
            $table->bigInteger('campaign_duration_id')->unsigned()->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->default('0');
            $table->dateTime('date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
            $table->string('message')->nullable();
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
        Schema::dropIfExists('bkash_payments');
    }
}
