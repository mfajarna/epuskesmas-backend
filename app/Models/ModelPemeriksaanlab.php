<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPemeriksaanlab extends Model
{
    use HasFactory;

    protected $table = "tb_pemeriksaanlab";
    protected $fillable = [
        'id_user',
        'tanggal',
        'no_rm',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'jenis_pemeriksaan'   => 'array'
    ];

    public function users()
    {
        return $this->belongsTo(ModelPasien::class ,'id_user');
    }
}
