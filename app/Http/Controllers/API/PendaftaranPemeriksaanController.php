<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ModelAntrian;
use Exception;
use Illuminate\Http\Request;

class PendaftaranPemeriksaanController extends Controller
{
    public function getListPoli()
    {
        try{
            $model = ModelAntrian::with('poli')->where('status', 'active')->get();

            return ResponseFormatter::success($model, 'Berhasil mengambil data Antrian Poli');
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Gagal Mengambil Kode Pasien');
        }
        
    }
}
