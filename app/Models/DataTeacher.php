<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTeacher extends Model
{
    protected $table = 'data_teachers'; // Nama tabel dalam basis data

    protected $fillable = [
        'name',
        'nip',
        'gender',
        'subject',
    ];

}