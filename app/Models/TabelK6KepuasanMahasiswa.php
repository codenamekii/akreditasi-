<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK6KepuasanMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tabel_k6_kepuasan_mahasiswas';
    protected $guarded = ['id'];
}
