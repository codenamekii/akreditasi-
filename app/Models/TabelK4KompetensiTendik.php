<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TabelK4KompetensiTendik extends Model
{
    use HasFactory;

    protected $table = 'tabel_k4_kompetensi_tendik';
    protected $guarded = ['id'];
    
    public function tendik()
    {
        return $this->belongsTo(TabelK4Tendik::class, 'id_tendik','id_tendik');
    }
}
