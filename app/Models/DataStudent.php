<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStudent extends Model
{
    protected $table = 'data_students'; // Nama tabel dalam basis data

    protected $fillable = [
        'name',
        'major_id',   
        'nisn',
        'no_hp',
        'alamat',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}