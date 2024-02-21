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
        Schema::create('data_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Lismah Nurhayati');
            $table->string('nip')->default('0123456789');
            $table->string('gender')->default('L');
            $table->string('subject')->default('Bahasa Indonesia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_teachers');
    }
};