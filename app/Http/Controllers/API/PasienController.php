<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Antrian\AntrianController;
use App\Models\DetailPasienModel;
use App\Models\ModelPasien;
use App\Models\ModelStatusVerifikasiKtp;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    use PasswordValidationRules;



    // Login Akun Pasien
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

            if(!Auth::guard('pasien_m')->attempt($credentials)){
                return ResponseFormatter::error([
                   'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = ModelPasien::where('email', $request->email)->first();
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

    // Register Akun Pasien
    public function register(Request $request)
    {
        try{
            $validation = $request->validate([
                'kode_pasien'       => 'required|string|unique:tb_pasien,kode_pasien',
                'nama_lengkap'      => 'required|string',
                'alamat'            => 'required|string|max:10000',
                'jenis_kelamin'     => 'required|string',
                'no_ktp'            => 'required|string|unique:tb_pasien,no_ktp',
                'no_handphone'      => 'required|string',
                'email'             => 'required|email',
                'password'          => 'required|string',
                // 'foto_ktp'          => 'required|file:jpg,jpeg,png|max:2048',
                'device_token'      => 'required|string'
                
            ]);

            // $path_foto_ktp = $request->file('foto_ktp')->store('assets/file/foto_ktp','public');

            $pasien = ModelPasien::create([
                'kode_pasien'       => $validation['kode_pasien'],
                'nama_lengkap'      => $validation['nama_lengkap'],
                'alamat'            => $validation['alamat'],
                'jenis_kelamin'     => $validation['jenis_kelamin'],
                'no_ktp'            => $validation['no_ktp'],
                'no_handphone'      => $validation['no_handphone'],
                'foto_ktp'          => NULL,
                'email'             => $validation['email'],
                'password'          => Hash::make($validation['password']),
                'is_verification'   => true,
                // 'foto_ktp'          => $path_foto_ktp,
                'device_token'      => $validation['device_token']

            ]);

            $tokenResult = $pasien->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'data_pasien' => $pasien
            ], 'Succesfully Registered Tenant!');
        }catch(Exception $e)
        {
            return ResponseFormatter::error([
                'message' => 'Something went wrong while register pasien',
                'error' => $e->getMessage()
            ], 'Authentication Failed', 500);
        }
    }

    // Detail Pasien
    public function detail_pasien(Request $request)
    {
        try{
            $validation = $request->validate([
                'pasien_id'         => 'required|integer',
                'berat_badan'       => 'required|string',
                'tinggi_badan'      => 'required|string',
                'gol_darah'         => 'required|string',
                'tanggal_lahir'     => 'required|string',
            ]);

            $detail_pasien = new DetailPasienModel();

            $detail_pasien->pasien_id       = $validation['pasien_id'];
            $detail_pasien->berat_badan     = $validation['berat_badan'];
            $detail_pasien->tinggi_badan    = $validation['tinggi_badan'];
            $detail_pasien->gol_darah       = $validation['gol_darah'];
            $detail_pasien->tanggal_lahir   = $validation['tanggal_lahir'];

            $detail_pasien->save();

            return ResponseFormatter::success('Berhasil Membuat data detail pasien', $detail_pasien);
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Gagal Mengambil Kode Pasien');
        }
    }

    public function generateKodePasien(Request $request)
    {

        try{
            $find_code = ModelPasien::max('kode_pasien');
        
            if($find_code)
            {
                $value_code = substr($find_code,10);
                $code = (int) $value_code;
                $code = $code + 1;
                $return_value = "PASIEN/".str_pad($code,4,"0",STR_PAD_LEFT);
            }else{
                $return_value = "PASIEN/0001";
            }
    
            return ResponseFormatter::success($return_value, 'Berhasil generate kode pasien');
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Gagal Mengambil Kode Pasien');
        }

    }


    public function updateFotoKtp(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'file'  => 'required|image:jpeg,png,jpg|max:2048'
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(['error'=>$validator->errors()], 'Update Photo Fails', 401);
            }

            if($request->file('file'))
            {
                $file = $request->file->store('assets/ktp', 'public');



                $ktp = ModelPasien::findOrFail(Auth::user()->id);
                $ktp->foto_ktp = $file;

                $ktp->update();

                $cekModelStatus = ModelStatusVerifikasiKtp::where('pasien_id', Auth::user()->id)->first();

                if($cekModelStatus)
                {
                    $cekModelStatus->status = "Menunggu Konfirmasi";
                    $cekModelStatus->save();
                }else{
                    $statusKtp = new ModelStatusVerifikasiKtp();
                    $statusKtp->pasien_id = Auth::user()->id;
                    $statusKtp->status = "Menunggu Konfirmasi";
    
                    $statusKtp->save();
                }
                return ResponseFormatter::success([$file],'File successfully uploaded');
            }
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }


    // Fetch status verifikasi KTP
    public function fetchKtpPasien(Request $request)
    {
        try{

            $id = Auth::user()->id;
            
            $model = ModelStatusVerifikasiKtp::where('pasien_id', $id)->first();

        
            // $arrModel = [];

            // foreach($model as $data)
            // {
            //     array_push($arrModel, $data['ktp']['status']);
            // }
            
            return ResponseFormatter::success($model,'Sukses mengambil data');
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }

    public function pasien(Request $request)
    {
        try{
            $model= ModelPasien::with(['ktp'])->latest()->get();

            $status_ktp = $model['ktp'];

            return ResponseFormatter::success($status_ktp,'Sukses mengambil data');
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }

    public function getStatusVerifikasiKtp(Request $request)
    {
        try{
            $id = $request->id;

            $model =  ModelStatusVerifikasiKtp::where('pasien_id', $id)
                                  ->select('status')
                                  ->first();

            
            return ResponseFormatter::success($model,'Sukses mengambil data status verifikasi');
                
        }catch(Exception $e)
        {
            return ResponseFormatter::error($e->getMessage(),'Something went wrong');
        }
    }
}
