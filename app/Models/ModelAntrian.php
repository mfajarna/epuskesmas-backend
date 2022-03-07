<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAntrian extends Model
{
    use HasFactory;

    protected $table = "tb_antrian";

    protected $fillable = [
        'id_poli',
        'status',
        'nomor_antrian'
    ];


    public function poli()
    {
        return $this->belongsTo(ModelPoli::class, 'id_poli');
    }  
}
