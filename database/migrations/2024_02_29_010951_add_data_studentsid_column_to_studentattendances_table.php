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
        Schema::table('studentattendances', function (Blueprint $table) {
            $table->unsignedBigInteger('data_students_id')->after('id')->required();
            $table->foreign('data_students_id')->references('id')->on('data_students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studentattendances', function (Blueprint $table) {
            Schema::dropIfExists('data_students_id');
        });
    }
};
