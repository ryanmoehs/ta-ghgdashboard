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
            // $table->float('total_ch4')->default(0);
            // $table->float('total_co2')->default(0);
            $table->integer('year');
            $table->integer('month');
            $table->enum('period_type', ['harian', 'bulanan', 'tahunan']);
            $table->string('category_code');
            $table->string('gas_type');
            $table->float('total_emission_ton');
            $table->text('komentar')->nullable();
            $table->enum('status', ['diproses', 'diteruskan', 'diterima', 'dikembalikan'])->default('diteruskan');
            $table->timestamp('tanggal');
            $table->text('kendala')->nullable();
            
            // $table->unsignedBigInteger('sensor_id')->default(0);
            // $table->foreign('sensor_id')->references('id')->on('mqtt_messages')->onDelete('cascade');
            $table->unsignedBigInteger('perusahaan_id')->default(0);
            $table->unsignedBigInteger('sumber_emisi_id')->default(0);
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
