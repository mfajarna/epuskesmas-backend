<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasilPemeriksaan extends Model
{
    use HasFactory;

    protected $table = "tb_hasil_pemeriksaan";
    protected $fillable = [
        'id_pemeriksaan',
        'id_pasien',
        'is_rujukan',
        'rujukan',
        'resep_obat',
        'keluhan_pasien'
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(ModelPemeriksaan::class, 'id_pemeriksaan');
    }

    public function pasien()
    {
        return $this->belongsTo(ModelPasien::class, 'id_pasien');
    }
}
