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
        Schema::create('campaign_summaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id')->unsigned();
            $table->bigInteger('campaign_duration_id')->unsigned();
            $table->integer('total_score')->default(0);
            $table->time('total_time_taken')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_summaries');
    }
};
