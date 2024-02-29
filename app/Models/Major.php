<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Major extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'majors'; // Disuaikan dengan nama tabel di database

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the students for the majors.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}

