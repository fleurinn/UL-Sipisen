<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'majors_id', 'classstudents_id', 'schedule_mondays_id', 'schedule_tuesdays_id', 'schedule_wednesdays_id', 'schedule_thursdays_id', 'schedule_fridays_id'
    ];

    /**
     * Get the major for the attendance.
     * one to many
     */
    public function majors()
    {
        return $this->belongsTo(Major::class, 'majors_id');
    }


    /**
     * Get the class for the attendance.
     * one to many
     */
    public function classstudents()
    {
        return $this->belongsTo(ClassStudent::class);
    }

    /**
     * Get the class for the attendance.
     * one to many
     */
    public function data_teachers()
    {
        return $this->belongsTo(DataTeacher::class)->select('id', 'name');
    }
    
    /**
     * Get the class for the attendance.
     * one to many
     */
    public function subjects()
    {
        return $this->belongsTo(Subject::class)->select('id', 'name');
    }

    /**
     * Get the schedule  for the data teacher.
     */
    public function schedule_mondays()
    {
        return $this->belongsTo(ScheduleMonday::class);
    }

    /**
     * Get the schedule  for the subject.
     */
    public function schedule_tuesdays()
    {
        return $this->belongsTo(ScheduleTuesday::class);
    }

    /**
     * Get the schedule  for the subject.
     */
    public function schedule_wednesdays()
    {
        return $this->belongsTo(ScheduleWednesday::class);
    }

    /**
     * Get the schedule  for the subject.
     */
    public function schedule_thursdays()
    {
        return $this->belongsTo(ScheduleThursday::class);
    }

    /**
     * Get the schedule  for the subject.
     */
    public function schedule_fridays()
    {
        return $this->belongsTo(ScheduleFriday::class);
    }


}
