<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'NIP',
        'Jabatan',
        'thumbnail',
        'nomor_telepon',
    ];
}
