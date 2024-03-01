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
            $table->unsignedBigInteger('majors_id')->after('data_students_id')->required();
            $table->unsignedBigInteger('classstudents_id')->after('majors_id')->required();

            $table->foreign('data_students_id')->references('id')->on('data_students');
            $table->foreign('majors_id')->references('id')->on('majors');
            $table->foreign('classstudents_id')->references('id')->on('classstudents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studentattendances', function (Blueprint $table) {
            $table->dropForeign(['data_students_id']);
            $table->dropForeign(['majors_id']);
            $table->dropForeign(['classstudents_id']);
            $table->dropColumn(['data_students_id', 'majors_id', 'classstudents_id']);
        });
    }
};
