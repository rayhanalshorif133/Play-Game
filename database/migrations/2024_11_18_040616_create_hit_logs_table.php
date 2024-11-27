<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHitLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hit_logs', function (Blueprint $table) {
            $table->id(); // id column (auto-increment primary key)
            $table->string('ip_address', 45); // IP address column
            $table->text('query_string')->nullable(); // Query string column
            $table->text('user_agent')->nullable(); // User agent column
            $table->text('additional_info')->nullable(); // Additional info column
            $table->date('date')->default(DB::raw('CURRENT_DATE')); // Log date column
            $table->time('time')->default(DB::raw('CURRENT_TIME')); // Log time column
            $table->timestamps(); // Includes created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hit_logs');
    }
}
