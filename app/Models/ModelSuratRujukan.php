<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSuratRujukan extends Model
{
    use HasFactory;

    protected $table = "tb_surat_rujukan_pasien";
    
    protected $fillable = [
        'id_pasien',
        'path_file_pdf',
        'name_file',
        'no_surat'
    ];

    public function pasien()
    {
        return $this->belongsTo(ModelPasien::class, 'id_pasien');
    }
}
