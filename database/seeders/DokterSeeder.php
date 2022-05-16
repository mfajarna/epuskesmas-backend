<?php

namespace Database\Seeders;

use App\Models\ModelDokter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dokter = [
            [
                'kode_dokter' => 'DOKTER001',
                'nama_dokter' => 'dr Yesicca Juliane Chandra',
                'jenis_kelamin' => 'Perempuan',
                'spesialis' => 'Dokter Umum',
                'device_token' => '',
                'tanggal_lahir' => 'Cirebon, 24 Juli 1991',
                'id_user' => 3
            ]
        ];

        ModelDokter::insert($dokter);
    }
}
