<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK9ProdukHki extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'tabel_k9_produk_hkis';
    protected $fillable = [];

     public function dosen()
    {
        return $this->belongsTo(TabelDosen::class, 'dosen_id', 'nidn_nidk');
    }
}
