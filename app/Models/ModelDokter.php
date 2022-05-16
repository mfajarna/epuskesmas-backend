<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDokter extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = "tb_dokter";

    protected $fillable = [
        'kode_dokter',
        'nama_dokter',
        'jenis_kelamin',
        'spesialis',
        'device_token',
        'tanggal_lahir',
        'id_user'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
