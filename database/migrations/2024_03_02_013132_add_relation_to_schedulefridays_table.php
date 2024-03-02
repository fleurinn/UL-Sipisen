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
        Schema::table('schedule_fridays', function (Blueprint $table) {
            $table->unsignedBigInteger('subjects_id')->after('id')->required();
            $table->unsignedBigInteger('data_teachers_id')->after('subjects_id')->required();

            $table->foreign('subjects_id')->references('id')->on('subjects');
            $table->foreign('data_teachers_id')->references('id')->on('data_teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_fridays', function (Blueprint $table) {
            $table->dropForeign(['data_teachers_id']);
            $table->dropForeign(['subjects_id']);
            $table->dropColumn(['data_teachers_id', 'subjects_id']);
        });
    }
};
