<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ModelUploadKonten;
use Exception;
use Illuminate\Http\Request;

class UploadKontenController extends Controller
{
    public function getDataKonten(Request $request)
    {
        try{
            $model = ModelUploadKonten::latest()->get();

            if($model)
            {
                return ResponseFormatter::success($model,'Sukses mengambil data konten');
            }else{
                return ResponseFormatter::success([],'Oops data tidak ada');
            }
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }
}
