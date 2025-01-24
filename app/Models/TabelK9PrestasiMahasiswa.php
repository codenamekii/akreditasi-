<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK9PrestasiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tabel_k9_prestasi_mahasiswas';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = ['id'];
}
