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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->enum('role', ['unit_pelaksana', 'induk_perusahaan', 'teknisi'])->default('induk_perusahaan');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('perusahaan_id')->nullable();
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans')->onDelete('cascade')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
