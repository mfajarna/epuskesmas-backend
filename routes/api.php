<?php

use App\Http\Controllers\API\AntrianPasienController;
use App\Http\Controllers\API\DokterController;
use App\Http\Controllers\API\PasienController;
use App\Http\Controllers\API\PendaftaranPemeriksaanController;
use App\Http\Controllers\API\SuratrujukanController;
use App\Http\Controllers\API\UploadKontenController;
use App\Models\Pasien_m;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    // Register Pasien
    Route::post('pasien/register', [PasienController::class,'register']);

    // Get Kode Pasien
    Route::get('pasien/getKodePasien', [PasienController::class, 'generateKodePasien']);

    // Login Pasien
    Route::post('pasien/login', [PasienController::class,'login']);

    // Login Dokter
    Route::post('dokter/login', [DokterController::class, 'login']);
    Route::get('dokter/riwayatkesehatanpasien', [DokterController::class, 'riwayatKesehatanPasien']);
    Route::get('dokter/getPemeriksaan', [DokterController::class, 'getPemeriksaan']);
    Route::get('dokter/riwayatobatpasien', [DokterController::class, 'riwayatObatPasien']);

    Route::get('getKontenInformasi', [UploadKontenController::class, 'getDataKonten']);

    Route::middleware('auth:sanctum')->group(function(){

        // Route Pasien KTP
        Route::post('pasien/detail_pasien', [PasienController::class, 'detail_pasien']);
        Route::post('pasien/updateFotoKtp', [PasienController::class,'updateFotoKtp']);
        Route::get('pasien/fetchKtp', [PasienController::class, 'fetchKtpPasien']);
        Route::get('pasien/fetchStatusKtp', [PasienController::class, 'getStatusVerifikasiKtp']);

        // Route Pendaftaran Pemeriksaan
        Route::get('pendaftaran/cek-antrian-poli', [PendaftaranPemeriksaanController::class, 'getListPoli']);
        Route::get('pendaftaran/getNoAntrian', [PendaftaranPemeriksaanController::class, 'getNoAntrian']);
        Route::post('pendaftaran/createPendaftaran', [PendaftaranPemeriksaanController::class, 'createPemeriksaan']);

 

    });

    Route::get('suratrujukan/getSuratRujukan', [SuratrujukanController::class,'getSuratRujukan']);

    // Route Status Antrian Pasien
    Route::get('antrianpasien/get-antrian', [AntrianPasienController::class,'getAntrianPasien']);
    
    Route::get('pasien/riwayatkesehatan', [PasienController::class,'getRiwayatKesehatan']);
    Route::get('pasien/riwayat-obat', [PasienController::class, 'getRiwayatObat']);

    Route::get('pasien/fetch', [PasienController::class, 'pasien']);
    Route::post('pasien/changePassword', [PasienController::class,'changePassword']);
    Route::post('pasien/changePasswordDokter', [PasienController::class,'changePasswordDokter']);
  