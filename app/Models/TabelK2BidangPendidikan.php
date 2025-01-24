<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK2BidangPendidikan extends Model
{
    use HasFactory;
    
    protected $table = 'tabel_k2_bidang_pendidikan';
    protected $guarded = ['id'];
}
