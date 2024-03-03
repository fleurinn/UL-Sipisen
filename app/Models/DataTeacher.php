<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTeacher extends Model
{
    protected $table = 'data_teachers'; // Nama tabel dalam basis data

    
    protected $fillable = [
        'name',
        'nip',
        'gender',
        'subject',
    ];

    /**
     * Get the schedule monday for the data teacher.
     */
    public function schedule_mondays()
    {
        return $this->hasMany(ScheduleMonday::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function schedule_tuesdays()
    {
        return $this->hasMany(ScheduleTuesday::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function schedule_wednesdays()
    {
        return $this->hasMany(ScheduleWednesday::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function schedule_thursdays()
    {
        return $this->hasMany(ScheduleThursday::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function schedule_fridays()
    {
        return $this->hasMany(ScheduleFriday::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function schedules()
    {
        return $this->hasOne(Schedule::class);
    }
}