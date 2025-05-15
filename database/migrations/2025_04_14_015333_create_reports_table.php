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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->float('total_ch4')->default(0);
            $table->float('total_co2')->default(0);
            $table->text('komentar')->nullable();
            $table->enum('status', ['draft', 'diproses', 'diteruskan', 'diterima', 'dikembalikan'])->default('draft');
            // $table->unsignedBigInteger('sensor_id')->default(0);
            // $table->foreign('sensor_id')->references('id')->on('mqtt_messages')->onDelete('cascade');
            $table->unsignedBigInteger('perusahaan_id')->default(0);
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
