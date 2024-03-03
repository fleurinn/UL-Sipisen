<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStudent extends Model
{
    protected $table = 'data_students'; // Nama tabel dalam basis data

    protected $fillable = [
        'classstudents_id',
        'name',
        'nisn',
        'no_hp',
        'alamat',
    ];

    /**
     * Get the student attendances for the Student.
     * one to many
     */
    public function studentAttendances()
    {
        return $this->hasMany(StudentAttendance::class, 'Data_Students_id');
    }

    /**
     * Get the schedule monday for the subject.
     */
    public function izins()
    {
        return $this->hasOne(Izin::class);
    }

    public function classstudents()
    {
        return $this->belongsTo(ClassStudent::class)->select('id', 'name');
    }
}