<?php

use App\Http\Controllers\Antrian\AntrianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Poli\PoliController;
use App\Http\Controllers\VerifikasiktpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('auth.login');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'],
    function()
        {
            Route::resource('/dashboard', DashboardController::class);

            // Route Poli
            Route::resource('/poli', PoliController::class);
                // Route Hapus
                Route::get('remove-poli', [PoliController::class, 'delete']);

            // Route Verifikasi KTP
            Route::resource('/verifikasiktp', VerifikasiktpController::class);
                Route::get('view-data-verifikasi', [VerifikasiktpController::class, 'fetchPasien'])->name('ktp.detail');
                Route::get('ktp-update-status', [VerifikasiktpController::class, 'editStatus'])->name('ktp.editstatus');


            // Route Antrian
            Route::resource('antrian', AntrianController::class);
            Route::get('/edit-status', [AntrianController::class, 'editStatus'])->name('antrian.editstatus');
            Route::get('/reset-antrian', [AntrianController::class, 'resetAntrian'])->name('antrian.reset');
            Route::get('/next-antrian', [AntrianController::class, 'nextAntrian'])->name('antrian.next');
        }
);
