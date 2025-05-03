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
            $table->string('sensor_id');
            $table->string('sensor_type')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->float('CH4')->nullable();
            $table->float('CH2')->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();
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
