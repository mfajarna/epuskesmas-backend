<?php

use App\Http\Controllers\API\PasienController;
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

    Route::middleware('auth:sanctum')->group(function(){

        // Route Pasien KTP
        Route::post('pasien/detail_pasien', [PasienController::class, 'detail_pasien']);
        Route::post('pasien/updateFotoKtp', [PasienController::class,'updateFotoKtp']);
        Route::get('pasien/fetchKtp', [PasienController::class, 'fetchKtpPasien']);
        


    });


    Route::get('pasien/fetch', [PasienController::class, 'pasien']);
