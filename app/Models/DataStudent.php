<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStudent extends Model
{
    protected $table = 'data_students'; // Nama tabel dalam basis data

    protected $fillable = [
        'name',
        'nisn',
        'no_hp',
        'alamat',
    ];

}