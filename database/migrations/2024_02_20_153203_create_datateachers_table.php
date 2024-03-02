<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTeachersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->required();
            $table->string('nip', 20)->required();
            $table->string('gender', 1)->required();
            $table->string('subject', 20)->required();
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