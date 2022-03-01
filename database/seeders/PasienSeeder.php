<?php

namespace Database\Seeders;

use App\Models\ModelPasien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pasien = [
            [
                'kode_pasien'   => 'PASIEN/0001',
                'nama_lengkap'  => 'Dummy Kojay',
                'alamat'        => 'Permata Cimahi II',
                'jenis_kelamin' => 'L',
                'no_ktp'        => '131300232',
                'no_handphone'  => '081388669867',
                'foto_ktp'      => NULL,
                'is_verification'   => true,
                'email'         => 'kojay@gmail.com',
                'password'      => Hash::make('Admin@123'),
                'is_active'     => true,
                'device_token'  => 'RANDOM',
                'is_verificationktp'    => false
            ]
        ];
        
        ModelPasien::insert($pasien);
    }
}
