<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jadwal_pikets'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hari','nip','name'
    ];
}
