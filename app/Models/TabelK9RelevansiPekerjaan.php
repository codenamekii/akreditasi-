<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK9RelevansiPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'tabel_k9_relevansi_pekerjaans';
    protected $guarded = ['id'];
    protected $fillable = [];
}
