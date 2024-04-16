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
        Schema::create('grent_tokens', function (Blueprint $table) {
            $table->id();
            $table->longText('id_token');
            $table->string('token_type');
            $table->string('expires_in');
            $table->time('expired_time');
            $table->longText('refresh_token');
            $table->date('created_date');
            $table->time('created_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grent_tokens');
    }
};
