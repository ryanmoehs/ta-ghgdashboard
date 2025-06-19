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
        Schema::create('thingspeak_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('channel_id');
            $table->string('api_read_key')->nullable();
            $table->string('description')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thingspeak_channels');
    }
};
