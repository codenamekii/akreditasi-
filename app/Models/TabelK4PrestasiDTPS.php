<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TabelK4PrestasiDTPS extends Model
{
    use HasFactory;

    protected $table = "tabel_k4_prestasi_dtps";
    protected $guarded = ['id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk', 'nidn_nidk');
    }
}
