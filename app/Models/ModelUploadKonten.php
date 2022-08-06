<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUploadKonten extends Model
{
    use HasFactory;

    protected $table = "tb_upload_konten";
    protected $fillable =[
        'judul_konten',
        'deskripsi_konten',
        'path_gambar'
    ];
}
