<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ModelAntrian;
use App\Models\ModelPemeriksaan;
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

    public function getNoAntrian(Request $request)
    {
        try{
            $id_poli = $request->id_poli;
            $nama_poli = $request->nama_poli;

            list($first_name, $second_name) = explode(' ', $nama_poli, 2);
            $first_name = explode(' ', $first_name);
            $second_name = explode(' ', $second_name);
    
            foreach($first_name as $key => $value)
            {
                $first_name[$key]=  $value[0];
            }
    
            foreach($second_name as $key => $value)
            {
                $second_name[$key]=  $value[0];
            }
    
            $namaAntrian = implode(' ', $first_name). implode(' ', $second_name);
            $find_code = ModelPemeriksaan::where('id_poli', $id_poli)->max('no_urut');
            
            if($find_code)
            {
                $value_code = substr($find_code,2);
                $code = (int) $value_code;
                $code = $code + 1;
                $no_antrian = $namaAntrian . $code;
            }else{
                $no_antrian = $namaAntrian . '1';
            }

            return ResponseFormatter::success($no_antrian, 'Berhasil mengambil data No Antrian');

        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }
}
