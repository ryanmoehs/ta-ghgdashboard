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
        Schema::create('sumber_emisis', function (Blueprint $table) {
            $table->id();
            $table->string('sumber')->nullable();
            $table->enum('tipe_sumber', ['kendaraan', 'alat_berat', 'boiler', 'lainnya']);
            $table->float('kapasitas_output')->nullable();
            $table->float('durasi_pemakaian');
            $table->integer('frekuensi_hari');
            $table->enum('unit', ['ton', 'liter'])->default('ton');
            $table->json('emission_factors');
            $table->unsignedBigInteger('id_fuel_properties');
            $table->foreign('id_fuel_properties')->references('id')->on('fuel_properties')->onDelete('cascade');
            $table->string('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_emisis');
    }
};
