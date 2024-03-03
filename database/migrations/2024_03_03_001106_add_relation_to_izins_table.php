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
        Schema::table('izins', function (Blueprint $table) {
            $table->unsignedBigInteger('data_students_id')->after('id')->required();
            $table->unsignedBigInteger('classstudents_id')->after('data_students_id')->required();
            $table->unsignedBigInteger('subjects_id')->after('tanggal')->required();

            $table->foreign('data_students_id')->references('id')->on('data_students');
            $table->foreign('classstudents_id')->references('id')->on('classstudents');
            $table->foreign('subjects_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izins', function (Blueprint $table) {
            $table->dropForeign(['data_students_id']);
            $table->dropForeign(['classstudents_id']);
            $table->dropForeign(['subjects_id']);
            $table->dropColumn(['data_students_id', 'classstudents_id', 'subjects_id']);
        });
    }
};
