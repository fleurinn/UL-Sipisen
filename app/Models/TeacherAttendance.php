<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $table = 'teacher_attendances';

    protected $fillable = [
        'data_teachers_id','tanggal', 'description'
    ];

    /**
     * Get the teacher for the attendance.
     * one to many
     */
    public function data_teachers()
    {
        return $this->belongsTo(DataTeacher::class, 'data_teachers_id')->select('id', 'name');
    }
}
