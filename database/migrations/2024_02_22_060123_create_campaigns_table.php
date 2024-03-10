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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->string('banner')->nullable();
            $table->string('type')->comment('quiz,game')->nullable();
            // for quiz:start
            $table->float('total_time_limit')->nullable();
            $table->integer('total_questions')->nullable();
            $table->integer('per_question_score')->nullable();
            $table->integer('per_q_time_limit')->nullable();
            // for quiz:end
            $table->tinyInteger('status')->default(1);
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
