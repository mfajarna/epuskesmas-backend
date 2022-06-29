<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ModelSuratRujukan;
use Exception;
use Illuminate\Http\Request;

class SuratrujukanController extends Controller
{
    public function getSuratRujukan(Request $request)
    {
        try{
            $id_pasien = $request->id_pasien;
            $model = ModelSuratRujukan::all();

            if($id_pasien)
            {
                $model = ModelSuratRujukan::where('id_pasien', $id_pasien)->latest()->get();
            }

            if($model)
            {
                return ResponseFormatter::success($model,'Sukses mengambil data status verifikasi');
            }else{
                return ResponseFormatter::success([],'Oops data tidak ada');
            }
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }

    }
}
