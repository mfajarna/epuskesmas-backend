<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class ModelDokter extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use HasProfilePhoto;
    use Notifiable;

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = "tb_dokter";
    protected $guard = "dokter_ms";

    protected $fillable = [
        'kode_dokter',
        'nama_dokter',
        'jenis_kelamin',
        'spesialis',
        'foto_dokter',
        'is_active',
        'email',
        'password',
        'device_token'
    ];


        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toArray(){
        $toArray = parent::toArray();
        $toArray['foto_dokter'] = $this->foto_ktp;

        return $toArray;
    }

    public function getFotoDokterAttribute()
    {
        return url('') . Storage::url($this->attributes['foto_dokter']);
    }
}
