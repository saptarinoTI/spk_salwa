<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalisasiModel extends Model
{
    use HasFactory;
    protected $table = 'normal';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'hasil'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'siswa_id', 'id');
    }
}
