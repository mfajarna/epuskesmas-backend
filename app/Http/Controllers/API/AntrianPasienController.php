<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ModelStatusAntrian;
use Exception;
use Illuminate\Http\Request;

class AntrianPasienController extends Controller
{
    public function getAntrianPasien(Request $request)
    {
        try{
            $id_pasien = $request->id_pasien;
            $model = ModelStatusAntrian::where('id_pasien', $id_pasien)->first();

            if($model)
            {
                return ResponseFormatter::success($model, 'Berhasil generate kode pasien');
            }else{
                return ResponseFormatter::error("Oops", 'Oops data tidak ada');
            }

        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong with server');
        }
    }
}
