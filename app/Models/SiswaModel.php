<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'pendaftar', 'jenjang', 'kondisi_ortu', 'penghasilan_ortu', 'kepemilikan_rmh', 'kepemilikan_hrt', 'pengeluaran_bln', 'hutang_bnk', 'hutang_lain', 'tahun'
    ];

    public function normal()
    {
        return $this->hasOne(NormalisasiModel::class, 'siswa_id', 'id');
    }
}
