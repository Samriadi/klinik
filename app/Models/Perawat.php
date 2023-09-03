<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_perawat', 
        'nip_perawat', 
        'nohp_perawat', 
        'foto_perawat', 
    ];
}
