<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TabelDosen;

class TabelK9Produk extends Model
{
    use HasFactory;

    protected $table = 'tabel_k9_produks';
    protected $guarded = ['id'];
    protected $fillable = [];

     public function dosen()
    {
        return $this->belongsTo(TabelDosen::class, 'dosen_id', 'nidn_nidk');
    }
}
