<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK6Bimbingan extends Model
{
    use HasFactory;

    protected $table = 'tabel_k6_bimbingans';
    protected $guarded = ['id'];

    
    public function dosen()
    {
        return $this->belongsTo(TabelDosen::class, 'nidn_nidk', 'nidn_nidk');
    }
}
