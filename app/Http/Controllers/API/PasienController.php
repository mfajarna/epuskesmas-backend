<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Models\DetailPasienModel;
use App\Models\ModelPasien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    use PasswordValidationRules;

    // Register Akun Pasien
    public function register(Request $request)
    {
        try{
            $validation = $request->validate([
                'kode_pasien'       => 'required|string|unique:tb_pasien,kode_pasien',
                'nama_lengkap'      => 'required|string',
                'alamat'            => 'required|string|max:10000',
                'jenis_kelamin'     => 'required|string',
                'no_ktp'            => 'required|string|unique:tb_pasien,no_ktp',
                'no_handphone'      => 'required|string',
                'email'             => 'required|email',
                'password'          => 'required|string',
                'foto_ktp'          => 'required|file:jpg,jpeg,png|max:2048'


            ]);

            $path_foto_ktp = $request->file('foto_ktp')->store('assets/file/foto_ktp','public');

            $pasien = ModelPasien::create([
                'kode_pasien'       => $validation['kode_pasien'],
                'nama_lengkap'      => $validation['nama_lengkap'],
                'alamat'            => $validation['alamat'],
                'jenis_kelamin'     => $validation['jenis_kelamin'],
                'no_ktp'            => $validation['no_ktp'],
                'no_handphone'      => $validation['no_handphone'],
                'email'             => $validation['email'],
                'password'          => Hash::make($validation['password']),
                'foto_ktp'          => $path_foto_ktp

            ]);

            $tokenResult = $pasien->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'data_pasien' => $pasien
            ], 'Succesfully Registered Tenant!');
        }catch(Exception $e)
        {
            return ResponseFormatter::error([
                'message' => 'Something went wrong while register pasien',
                'error' => $e->getMessage()
            ], 'Authentication Failed', 500);
        }
    }

    // Detail Pasien
    public function detail_pasien(Request $request)
    {
        try{
            $validation = $request->validate([
                'pasien_id'         => 'required|integer',
                'berat_badan'       => 'required|string',
                'tinggi_badan'      => 'required|string',
                'gol_darah'         => 'required|string',
                'tanggal_lahir'     => 'required|string',
            ]);

            $detail_pasien = new DetailPasienModel();

            $detail_pasien->pasien_id       = $validation['pasien_id'];
            $detail_pasien->berat_badan     = $validation['berat_badan'];
            $detail_pasien->tinggi_badan    = $validation['tinggi_badan'];
            $detail_pasien->gol_darah       = $validation['gol_darah'];
            $detail_pasien->tanggal_lahir   = $validation['tanggal_lahir'];

            $detail_pasien->save();

            return ResponseFormatter::success('Berhasil Membuat data detail pasien', $detail_pasien);
        }catch(Exception $e)
        {

        }
    }
}
