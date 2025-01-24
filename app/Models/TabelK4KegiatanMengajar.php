<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TabelK4KegiatanMengajar extends Model
{
    use HasFactory;

    protected $table = "tabel_k4_kegiatan_mengajar";
    protected $guarded = ['id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk', 'nidn_nidk');
    }

    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(TabelMatakuliah::class, 'kode_mk', 'kode_mk');
    }
}
