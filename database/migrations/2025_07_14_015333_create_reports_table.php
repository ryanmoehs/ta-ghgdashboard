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
            $table->enum('period_type', ['harian', 'bulanan', 'tahunan']);
            $table->date('period_date')->nullable();
            $table->string('category_code');
            $table->float('total_co2')->default(0);
            $table->float('total_ch4')->default(0);
            $table->float('total_n2o')->default(0);
            $table->float('avg_co2')->nullable();
            $table->float('avg_ch4')->nullable();
            $table->float('avg_n2o')->nullable();
            $table->text('komentar')->nullable();
            $table->text('kendala')->nullable();
            
            // $table->unsignedBigInteger('sensor_id')->default(0);
            $table->unsignedBigInteger('perusahaan_id')->default(0);
            $table->unsignedBigInteger('sumber_emisi_id')->default(0);
            $table->unsignedBigInteger('sensor_id')->default(0);
            $table->foreign('sensor_id')->references('id')->on('sensor_entries')->onDelete('cascade');
            $table->foreign('sumber_emisi_id')->references('id')->on('sumber_emisis')->onDelete('cascade');
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
