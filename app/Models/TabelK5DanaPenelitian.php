<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TabelK5DanaPenelitian extends Model
{
    use HasFactory;

    protected $table = "tabel_k5_dana_penelitians";
    protected $guarded = ['id'];

    public function dosen(): BelongsTo {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk','nidn_nidk');
    }
}
