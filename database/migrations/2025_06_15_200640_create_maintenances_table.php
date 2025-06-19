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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat')->default('-');
            $table->enum('jenis_alat', [
                'sensor',
                'aktuator',
            ]);
            $table->enum('jenis_maintenance', [
                'perbaikan',
                'penggantian',
            ]);
            $table->datetime('waktu_mulai')->nullable();
            $table->datetime('waktu_selesai')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status', ['waiting', 'in_progress', 'selesai'])->default('waiting'); // waiting, in_progress, completed
            $table->string('teknisi');
            $table->unsignedBigInteger('thingspeak_channel_id');
            $table->foreign('thingspeak_channel_id')->references('id')->on('thingspeak_channels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
