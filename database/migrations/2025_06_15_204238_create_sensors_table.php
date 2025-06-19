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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('sensor_name');
            $table->string('field'); // e.g., "field1", "field2", etc.
            $table->string('parameter_name'); // e.g., "Temperature", "CO2"
            $table->string('unit'); // e.g., "Celsius", "ppm", etc.
            $table->string('description')->nullable(); // Optional description of the sensor
            $table->decimal('latitude', 10, 8)->nullable(); // Latitude of the sensor location
            $table->decimal('longitude', 11, 8)->nullable(); // Longitude of the sensor location
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
