<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK2BidangKelembagaan extends Model
{
    use HasFactory;

    protected $table = "tabel_k2_bidang_pengembangan_kelembagaan";
    protected $guarded = ['id'];
}
