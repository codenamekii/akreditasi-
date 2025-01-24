<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repository;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    public function repository()
    {
        return $this->belongsTo(Repository::class, 'repository_id');
    }
}
