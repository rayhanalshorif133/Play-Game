<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\DatabaseSeeder;

class CreateScoreLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_logs', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn');
            $table->string('score');
            $table->string('game_keyword');
            $table->string('status')->default('1');
            $table->string('flag')->nullable();
            $table->string('url')->nullable();
            $table->date('play_date')->nullable();
            $table->time('play_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('platform')->nullable(); 
            $table->timestamps();
        });


        $dbSeeder = new DatabaseSeeder();
        $dbSeeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_logs');
    }
}
