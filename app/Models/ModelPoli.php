<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPoli extends Model
{
    use HasFactory;

    protected $table = "tb_poli";

    protected $fillable = [
        'nama_poli',
        'desc_poli',
        'status'
    ];
}
