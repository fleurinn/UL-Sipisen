<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the schedule monday for the subject.
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

    /**
     * Get the schedule monday for the subject.
     */
    public function izins()
    {
        return $this->hasOne(Izin::class);
    }
}
