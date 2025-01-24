<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK3MahasiswaReguler extends Model
{
    use HasFactory;

    protected $table = "tabel_k3_mahasiswa_reguler";
    protected $guarded = ['id'];
}
