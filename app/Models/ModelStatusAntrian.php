<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStatusAntrian extends Model
{
    use HasFactory;

    protected $table = "tb_status_antrian";
    protected $fillable = [
        'id_pemeriksaan',
        'id_pasien',
        'no_urut',
        'status'
    ];


    public function pasien()
    {
        return $this->belongsTo(ModelPasien::class, 'id_pasien');
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(ModelPemeriksaan::class, 'id_pemeriksaan');
    }
}
