<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK9KepuasanPengguna extends Model
{
    use HasFactory;

    protected $table = 'tabel_k9_kepuasan_penggunas';

    protected $guarded = ['id'];
    
    protected $fillable = [];

}
