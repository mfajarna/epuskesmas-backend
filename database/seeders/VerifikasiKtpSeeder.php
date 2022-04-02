<?php

namespace Database\Seeders;

use App\Models\ModelStatusVerifikasiKtp;
use Illuminate\Database\Seeder;

class VerifikasiKtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = [
            [
                'pasien_id' => 1,
                'status'    => 'Menunggu Konfirmasi'

            ]
        ];

        ModelStatusVerifikasiKtp::insert($model);
    }
}
