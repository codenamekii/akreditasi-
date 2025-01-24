<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK3LayananPembinaanMahasiswa extends Model
{
    use HasFactory;
    protected $table = "tabel_k3_layanan_pembinaan_mahasiswa";
    protected $guarded = ['id'];
}
