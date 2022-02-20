<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPasienModel extends Model
{
    use HasFactory;

    protected $table = "tb_detail_pasien";

    protected $fillable = [
        'pasien_id',
        'berat_badan',
        'tinggi_badan',
        'gol_darah',
        'tanggal_lahir',
    ];

    public function pasien()
    {
        return $this->belongsTo(ModelPasien::class);
    }

}
