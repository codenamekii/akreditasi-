<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TabelK6IntegrasiPenelitianPKMPembelajaran extends Model
{
    use HasFactory;

    protected $table = "tabel_k6_integrasi_tridarma";
    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk', 'nidn_nidk');
    }

    public function matakuliah()
    {
        return $this->belongsTo(TabelMatakuliah::class, 'mk_id', 'kode_mk');
    }
}
