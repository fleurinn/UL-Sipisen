<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleMonday extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedule_mondays'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subjects_id', 'data_teachers_id', 'start_time', 'end_time'
    ];


    /**
     * Get the data teacher for the schedule monday.
     */
    public function subjects()
    {
        return $this->belongsTo(Subject::class)->select('id','name');
    }

    /**
     * Get the data teacher for the schedule monday.
     */
    public function data_teachers()
    {
        return $this->belongsTo(DataTeacher::class)->select('id','name');
    }

    /**
     * Get the student schedule .
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
