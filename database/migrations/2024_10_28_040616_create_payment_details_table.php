<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_id')->unsigned();
            $table->string('keyword', 10)->nullable();
            $table->string('msisdn', 15)->nullable();
            $table->string('type', 20)->nullable();
            $table->string('acr', 40)->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->string('result', 10)->nullable();
            $table->json('response')->nullable();
            $table->dateTime('date_time');
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
        Schema::dropIfExists('payment_details');
    }
}
