<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'kode', 'nama', 'nilai'
    ];
}
