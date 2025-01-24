<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TabelK4Tendik extends Model
{
    use HasFactory;
    
    protected $table = 'tabel_tendik';
    protected $guarded = ['id'];

    public function kompetensi()
    {
        return $this->hasMany(TabelK4KompetensiTendik::class, 'id_tendik');
    }
    
}
