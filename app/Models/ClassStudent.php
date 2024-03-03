<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassStudent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classstudents'; // Disuaikan dengan nama tabel di database

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'majors_id','name'
    ];



    /**
     * Get the student attendances for the major.
     */
    public function StudentAttendances()
    {
        return $this->hasMany(StudentAttendance::class, 'classstudents_id');
    }

    /**
     * Get the student schedule .
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function izins()
    {
        return $this->hasOne(Izin::class);
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function majors()
    {
        return $this->belongsTo(Major::class)->select('id', 'name');
    }

    public function data_students()
    {
        return $this->hasMany(DataStudent::class);
    }
}

