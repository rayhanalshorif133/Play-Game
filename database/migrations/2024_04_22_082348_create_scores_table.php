<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn');
            $table->bigInteger('campaign_id')->unsigned()->nullable();
            $table->bigInteger('campaign_duration_id')->unsigned()->nullable();
            $table->string('score');
            $table->string('game_keyword');
            $table->string('status')->default('1');
            $table->string('url')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();            
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
        Schema::dropIfExists('scores');
    }
}
