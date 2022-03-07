<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class ModelPasien extends Authenticatable
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

    protected $table = "tb_pasien";
    protected $guard = "pasien_m";

    protected $fillable = [
        'kode_pasien',
        'nama_lengkap',
        'alamat',
        'jenis_kelamin',
        'no_ktp',
        'foto_ktp',
        'no_handphone',
        'is_verification',
        'email',
        'password',
        'is_active',
        'is_verificationktp',
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
        $toArray['foto_ktp'] = $this->foto_ktp;

        return $toArray;
    }

    public function getFotoKtpAttribute()
    {
        return url('') . Storage::url($this->attributes['foto_ktp']);
    }


    public function detail_pasien()
    {
        return $this->hasOne(DetailPasienModel::class);
    }

    public function ktp()
    {
        return $this->hasOne(ModelStatusVerifikasiKtp::class, 'id');
    }





}
