<?php

use App\Http\Controllers\Antrian\AntrianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\KiosController;
use App\Http\Controllers\PemeriksaanDokterController;
use App\Http\Controllers\PemeriksaanLaboratoriumController;
use App\Http\Controllers\PendaftaranPemeriksaanController;
use App\Http\Controllers\Poli\PoliController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\SuratrujukanController;
use App\Http\Controllers\VerifikasiktpController;
use Illuminate\Support\Facades\Artisan;
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

Route::resource('/cek-antrian', KiosController::class);

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/sms', [VerifikasiktpController::class, 'sendNotificationSms']);


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

            // Pendaftaran Pasien
            Route::resource('pendaftaranpemeriksaanpasien', PendaftaranPemeriksaanController::class);
                route::get('pendaftaranpemeriksaanpasien', [PendaftaranPemeriksaanController::class,'index']);
                Route::get('pendaftaranpemeriksaanpasien/pendaftaran/{id_poli}/{nama_poli}', [PendaftaranPemeriksaanController::class, 'pendaftaran'])->name('pendaftaranpemeriksaanpasien.pendaftaran');
                Route::post('/autocomplete-search', [PendaftaranPemeriksaanController::class, 'autocompleteSearch'])->name('autocomplete.pasien');
                Route::get('/pendaftaran-dokter', [PendaftaranPemeriksaanController::class, 'regisDokterFbase']);
            // Dokter
            Route::resource('pemeriksaandokter', PemeriksaanDokterController::class);
                Route::get('pemeriksaandokter/pemeriksaan/{id_poli}/{nama_poli}', [PemeriksaanDokterController::class, 'pemeriksaan'])->name('pemeriksaandokter.pemeriksaan');
                Route::get('datapemeriksaan/{id}', [PemeriksaanDokterController::class, 'dataPemeriksaan']);
                

            // Riwayat Pasien
            Route::resource('riwayatpasien', RiwayatPasienController::class);
                Route::get('getPasien', [RiwayatPasienController::class, 'getPasien'])->name('riwayatpasien.getpasien');
                Route::get('get-riwayat-berobat', [RiwayatPasienController::class, 'getRiwayatBerobat'])->name('riwayatpasien.getriwayat');
                Route::get('pdf-riwayat-pasien', [RiwayatPasienController::class, 'pdfRiwayatPasien'])->name('riwayat.pdf-pasien');

            // Surat Rujukan
            Route::resource('suratrujukan', SuratrujukanController::class);
                Route::get('pdf-surat-rujukan', [SuratrujukanController::class, 'showPdfRujukan'])->name('showPdfRujukan');
                Route::get('show-rujukan', [SuratrujukanController::class, 'showSuratRujukan'])->name('suratrujukan.showRujukan');
                Route::get('download-pdf/{files}', [SuratrujukanController::class,'downloadPDF'])->name('suratrujukan.download');

            // Pemeriksaan Lab
            Route::resource('pemeriksaanlab', PemeriksaanLaboratoriumController::class);
                Route::get('/form-pemeriksaan-lab', [PemeriksaanLaboratoriumController::class,'printFormulirPemeriksaanLab']);
        }
);
