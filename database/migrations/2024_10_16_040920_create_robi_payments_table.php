<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobiPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robi_payments', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn')->nullable();
            $table->string('aocTransID')->nullable();
            $table->string('transaction_id')->nullable();
            $table->bigInteger('status')->nullable()->default(0);
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('chargeStatus')->nullable();
            $table->string('code')->comment('00 for successful, others for failed');
            $table->json('response')->nullable();
            $table->dateTime('date_time')->nullable();
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
        Schema::dropIfExists('robi_payments');
    }
}
