<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStudent extends Model
{
    protected $table = 'data_students'; // Nama tabel dalam basis data

    protected $fillable = [
        'name',
        'majors_id',
        'classstudents_id',   
        'nisn',
        'no_hp',
        'alamat',
    ];

    /**
     * Get the Majors for the Student.
     * one to many
     */
    public function majors()
    {
        return $this->belongsTo(Major::class)->select('id', 'name');
    }

    /**
     * Get the class for the Student.
     * one to many
     */
    public function classstudents()
    {
        return $this->belongsTo(ClassStudent::class)->select('id', 'name');
    }

    /**
     * Get the student attendances for the Student.
     * one to many
     */
    public function studentAttendances()
    {
        return $this->hasMany(StudentAttendance::class, 'Data_Students_id');
    }
}