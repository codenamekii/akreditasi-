<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TabelK4BebanKerjaDTPS extends Model
{
    use HasFactory;

    protected $table = 'tabel_k4_beban_kerja_dtps';
    protected $guarded = ['id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk', 'nidn_nidk');
    }
}


