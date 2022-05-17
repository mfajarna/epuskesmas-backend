<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'tb_pemeriksaan';

    protected $fillable = [
        'id_pasien',
        'id_poli',
        'no_urut',
        'umur',
        'status',
        'corrected_by',
        'kunjungan'
    ];

    public function pasien()
    {
        return $this->belongsTo(ModelPasien::class, 'id_pasien');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'corrected_by');
    }

    public function poli()
    {
        return $this->belongsTo(ModelPoli::class, 'id_poli');
    }
}
