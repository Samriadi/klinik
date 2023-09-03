<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $fillable = [
        'identitas_pasien', 
        'tanggal_berobat', 
        'gejala_pasien', 
        'obat_pasien',
        'perawat',
        'dokter', 
    ];
}
