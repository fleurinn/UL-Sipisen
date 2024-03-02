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
        Schema::table('schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('majors_id')->after('id')->required();
            $table->unsignedBigInteger('classstudents_id')->after('majors_id')->required();
            $table->unsignedBigInteger('schedule_mondays_id')->after('classstudents_id')->required();
            $table->unsignedBigInteger('schedule_tuesdays_id')->after('schedule_mondays_id')->required();
            $table->unsignedBigInteger('schedule_wednesdays_id')->after('schedule_tuesdays_id')->required();
            $table->unsignedBigInteger('schedule_thursdays_id')->after('schedule_wednesdays_id')->required();
            $table->unsignedBigInteger('schedule_fridays_id')->after('schedule_thursdays_id')->required();


            $table->foreign('majors_id')->references('id')->on('majors');
            $table->foreign('classstudents_id')->references('id')->on('classstudents');
            $table->foreign('schedule_mondays_id')->references('id')->on('schedule_mondays');
            $table->foreign('schedule_tuesdays_id')->references('id')->on('schedule_tuesdays');
            $table->foreign('schedule_wednesdays_id')->references('id')->on('schedule_wednesdays');
            $table->foreign('schedule_thursdays_id')->references('id')->on('schedule_thursdays');
            $table->foreign('schedule_fridays_id')->references('id')->on('schedule_fridays');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['majors_id']);
            $table->dropForeign(['classstudents_id']);
            $table->dropForeign(['schedule_mondays_id']);
            $table->dropForeign(['schedule_tuesdays_id']);
            $table->dropForeign(['schedule_wednesdays_id']);
            $table->dropForeign(['schedule_thursdays_id']);
            $table->dropForeign(['schedule_fridays_id']);
            $table->dropColumn(['majors_id','classstudents_id', 'schedule_mondays_id','schedule_tuesdays_id','schedule_wednesdays_id','schedule_thursdays_id', 'schedule_fridays_id']);
        });
    }
};
