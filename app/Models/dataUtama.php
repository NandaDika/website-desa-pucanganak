<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataUtama extends Model
{
    use HasFactory;

    protected $fillable = [
        'koordinat',
        'kode_desa',
        'tahun_pembentukan',
        'dasar_hukum',
        'tipologi',
        'klasifikasi',
        'kategori',
        'luas_wilayah',
        'batas_utara',
        'batas_selatan',
        'batas_timur',
        'batas_barat',
        'link_gmaps',
        'gambar_struktur'
    ];
}
