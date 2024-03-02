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
        'name'
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
}
