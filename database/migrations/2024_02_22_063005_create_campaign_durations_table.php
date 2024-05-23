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
        Schema::create('campaign_durations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('amount');
            $table->string('play_type')->comment('campaign,tournament')->default('campaign');
            $table->bigInteger('campaign_id')->unsigned();
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->bigInteger('game_id')->unsigned();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_durations');
    }
};
