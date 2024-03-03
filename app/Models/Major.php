<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'majors'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];


    /**
     * Get the student attendances for the major.
     */
    public function studentattendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    /**
     * Get the student schedule for the major.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the student attendances for the major.
     */
    public function classstudents()
    {
        return $this->hasMany(ClassStudent::class);
    }
}
