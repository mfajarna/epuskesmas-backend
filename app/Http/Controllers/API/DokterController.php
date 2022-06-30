<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ModelHasilPemeriksaan;
use App\Models\ModelPemeriksaan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ],[
                'email.required' => 'Silahkan masukan email yang valid!',
                'password.required' => 'Silahkan masukan password yang benar!'
            ]);

            $credentials = request(['email', 'password']);


            if(!Auth::guard('web')->attempt($credentials)){
                return ResponseFormatter::error([
                   'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }


            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password)){
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authentication');

        }catch(Exception $e)
        {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $e->getMessage(),
            ], 'Authentication Failed', 500);
        }
    }

    public function riwayatKesehatanPasien(Request $request)
    {
        try{
            $id = $request->id_pasien;
            
            $model = ModelHasilPemeriksaan::orderBy('id_pasien','asc')->get();

            if($id)
            {
                $model = ModelHasilPemeriksaan::where('id_pasien', $id)->latest()->get();
            }

            if($model)
            {
                return ResponseFormatter::success($model,'Sukses mengambil data');
            }else{
                return ResponseFormatter::success([],'Oops data tidak ada');
            }

        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Gagal Mengambil Kode Pasien');
        }
    }

    public function riwayatObatPasien(Request $request)
    {
        try{
            $id = $request->id_pasien;
            $model = ModelHasilPemeriksaan::where('id_pasien', $id)
                    ->select('id','resep_obat')
                    ->latest()->get();

            

            if($model)
            {
                return ResponseFormatter::success($model,'Sukses mengambil data');
            }else{
                return ResponseFormatter::success([],'Oops data tidak ada');
            }
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }

    public function getPemeriksaan(Request $request)
    {
        try{
            $model = ModelPemeriksaan::with('pasien')->where('status_pemeriksaan', 'MENUNGGU')->get();

            if($model)
            {
                return ResponseFormatter::success($model,'Sukses mengambil data');
            }else{
                return ResponseFormatter::success([],'Oops data tidak ada');
            }
            
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong'); 
        }
    }
}
