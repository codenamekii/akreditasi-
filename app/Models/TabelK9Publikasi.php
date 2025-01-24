<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK9Publikasi extends Model
{
    use HasFactory;

    protected $table = 'tabel_k9_publikasis';
    protected $guarded = ['id'];
    protected $fillable = [];

}
