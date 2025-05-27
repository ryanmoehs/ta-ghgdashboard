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
        Schema::create('fuel_combustion_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sumber_emisis');
            $table->string('source_name');
            $table->string('fuel_type');
            $table->float('quantity_used');
            $table->string('unit');
            $table->float('conversion_factor');
            $table->json('emission_factor');
            $table->json('total_emission_ton');
            $table->date('period');
            $table->foreign('id_sumber_emisis')
                ->references('id')
                ->on('sumber_emisis')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_combustion_activities');
    }
};
