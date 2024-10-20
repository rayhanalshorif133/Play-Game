<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUnsubsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_unsubs_logs', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn'); // The phone number
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->unsignedBigInteger('robi_payment_id')->nullable();
            $table->string('type')->enum('subs', 'unsubs')->default('unsubs');
            $table->string('keyword')->nullable();
            $table->string('status')->nullable();
            $table->string('message')->nullable()->default('ok');
            $table->timestamp('date_time');
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
        Schema::dropIfExists('sub_unsubs_logs');
    }
}
