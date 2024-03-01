<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $table = 'studentattendances';

    protected $fillable = [
        'data_students_id','majors_id', 'classstudents_id', 'description'
    ];

    /**
     * Get the student for the attendance.
     * one to many
     */
    public function data_students()
    {
        return $this->belongsTo(DataStudent::class, 'data_students_id')->select('id', 'name');
    }

    /**
     * Get the major for the attendance.
     * one to many
     */
    public function majors()
    {
        return $this->belongsTo(Major::class, 'majors_id')->select('id', 'name');
    }


    /**
     * Get the class for the attendance.
     * one to many
     */
    public function classstudents()
    {
        return $this->belongsTo(ClassStudent::class, 'classstudents_id')->select('id', 'name');
    }
}
