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
        Schema::table('data_students', function (Blueprint $table) {
            $table->unsignedBigInteger('classstudents_id')->after('id')->required();

            $table->foreign('classstudents_id')->references('id')->on('classstudents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_students', function (Blueprint $table) {
            $table->dropForeign(['classstudents_id']);
            $table->dropColumn(['classstudents_id']);
        });
    }
};
