<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStatusVerifikasiKtp extends Model
{
    use HasFactory;

    protected $table = 'tb_status_verifikasi_ktp';

    protected $fillable = [
        'pasien_id',
        'status'
    ];


    public function pasien()
    {
        return $this->belongsTo(ModelPasien::class, 'pasien_id');
    }

}
