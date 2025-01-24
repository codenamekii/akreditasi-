<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK8PelibatanMhsPkm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dosen_ketua(){
        return $this->belongsTo(TabelDosen::class, 'dosen_ketua_id', 'nidn_nidk');
    }
    public function dosen_anggota(){
        return $this->belongsTo(TabelDosen::class, 'dosen_anggota_id', 'nidn_nidk');
    }
}