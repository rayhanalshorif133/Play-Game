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
        Schema::create('campaign_score_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('campaign_id')->unsigned();
            $table->bigInteger('campaign_duration_id')->unsigned();
            $table->bigInteger('question_id')->unsigned()->nullable();
            $table->string('answer')->nullable();
            $table->string('type')->comment('right','wrong')->nullable();
            $table->time('time_taken')->nullable();
            $table->integer('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_score_logs');
    }
};
