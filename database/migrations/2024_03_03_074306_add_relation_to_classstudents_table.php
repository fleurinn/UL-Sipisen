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
        Schema::table('classstudents', function (Blueprint $table) {
            $table->unsignedBigInteger('majors_id')->after('id')->required();

            $table->foreign('majors_id')->references('id')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classstudents', function (Blueprint $table) {
            $table->dropForeign(['majors_id']);
            $table->dropColumn(['majors_id']);
        });
    }
};
