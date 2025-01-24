<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK6DosenTamuTenagaAhli extends Model
{
    use HasFactory;

    protected $table = 'tabel_k6_dosen_tamu_tenaga_ahlis';
    protected $guarded = ['id'];
    public function matakuliah()
    {
        return $this->belongsTo(TabelMatakuliah::class, 'mk_id', 'id');
    }
}
