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
        Schema::create('sensor_entries', function (Blueprint $table) {
            $table->id();
            $table->string('sensor_id');
            $table->string('entry_id');
            $table->float('wind_speed');
            $table->float('wind_direction');
            $table->float('temperature');
            $table->float('humidity');
            $table->float('pm25');
            $table->float('pm10');
            $table->float('ch4');
            $table->float('co2');
            $table->timestamp('inserted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_entries');
    }
};
