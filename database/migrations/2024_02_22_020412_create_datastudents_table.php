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
        Schema::create('data_students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Adhya Setyawati');
            $table->integer('nisn')->default('0123456789');
            $table->string('no_hp')->default('011123456789');
            $table->string('alamat')->default('JLN. Raya Jembatan Cinangneng 02/03, Bogor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_students');
    }
};