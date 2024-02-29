<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $table = 'studentattendances';

    protected $fillable = [
        'data_students_id', 'description'
    ];

    /**
     * Get the student for the attendance.
     */
    public function data_students()
    {
        return $this->belongsTo(DataStudent::class, 'data_students_id')->select('id', 'name');
    }
}
