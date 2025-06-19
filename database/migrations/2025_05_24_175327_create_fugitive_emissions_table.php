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
        Schema::create('fugitive_emissions', function (Blueprint $table) {
            $table->id();
            $table->string('source_name');
            $table->float('production_amount');
            $table->float('emission_factor');
            $table->float('ch4_emission_ton');
            $table->float('co2_emission_ton'); // Optional, if needed
            $table->float('co2e_emission_ton');
            $table->date('period');
            $table->unsignedBigInteger('company_id')->default(1); // Default to 1 if no company
            $table->foreign('company_id')->references('id')->on('perusahaans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fugitive_emissions');
    }
};
