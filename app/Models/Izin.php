<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izins';

    protected $fillable = [
        'data_students_id', 'classstudents_id', 'tanggal', 'subjects_id', 'description'
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
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subjects_id')->select('id', 'name');
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
