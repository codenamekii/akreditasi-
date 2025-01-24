<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK6KegiatanAkademik extends Model
{
    use HasFactory;

    protected $table = 'tabel_k6_kegiatan_akademiks';
    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk', 'nidn_nidk');
    }
}
