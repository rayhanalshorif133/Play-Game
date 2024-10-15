<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobiCreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robi_create_payments', function (Blueprint $table) {
            $table->id();
            $table->string('aocTransID')->nullable(); // Add a column for aocTransID
            $table->string('redirectURL')->nullable(); // Add a column for redirectURL
            $table->string('spTransID')->nullable(); // Add a column for spTransID
            $table->json('response')->nullable(); // Add a column for spTransID
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
        Schema::dropIfExists('robi_create_payments');
    }
}
