<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn')->nullable()->unique();
            $table->string('aocTransID')->nullable(); // Add a column for aocTransID
            $table->string('keyword')->nullable();
            $table->bigInteger('status')->nullable()->default(0);
            $table->string('subs_date')->nullable();
            $table->string('unsubs_date')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
