<?php

namespace App\Http\Controllers;

use App\Models\ModelPasien;
use App\Models\ModelStatusVerifikasiKtp;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Nexmo\Laravel\Facade\Nexmo;

class VerifikasiktpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model = ModelStatusVerifikasiKtp::with('pasien')->get();

        if(request()->ajax())
        {
            return DataTables::of($model)
            ->addColumn('status_button', function($tipe)
            {
                if($tipe->status == "Belum Upload KTP")
                {
                    $button = '<button type="button" name="status_ktp" id="status_ktp" class="btn btn-info waves-effect waves-light" disabled>';
                    $button .=  '<i class="bx bx-info-circle font-size-16 align-middle me-2"></i>Belum Upload KTP</button>';
                }
                if($tipe->status == "Menunggu Konfirmasi")
                {
                    $button = '<button type="button" name="status_ktp" id="status_ktp" class="btn btn-warning waves-effect waves-light">';
                    $button .=  '<i class="bx bx-error font-size-16 align-middle me-2"></i> Menunggu Konfirmasi </button>';
                }if($tipe->status == "Sudah Konfirmasi")
                {
                    $button = '<button type="button" name="status_ktp" id="status_ktp" class="btn btn-success waves-effect waves-light" disabled>';
                    $button .=  '<i class="bx bx-check-double font-size-16 align-middle me-2"></i>Sudah Konfirmasi</button>';
                }


                return $button;
                
            })
            ->addColumn('waktu_upload', function($tipe)
            {
                $date = $tipe->created_at;

                $dateFormat = date_format($date, 'Y-m-d H:i:s');

                $status = '<span class="badge rounded-pill bg-info">'. $dateFormat . '</span>';


                return $status;
            })
            ->addColumn('button_detail', function($tipe)
            {
                $button_status = '<button type="button" name="detail" id="detail" class="btn btn-primary btn-rounded waves-effect waves-light w-lg">Lihat KTP</button>';
                

                return $button_status;
            })
            ->rawColumns(['status_button','waktu_upload','button_detail'])
            ->make(true);
        }

        return view('pages.dashboard.ktp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function fetchPasien(Request $request)
    {
        $id = $request->id;

        $model = ModelStatusVerifikasiKtp::with('pasien')->where('id', $id)->get();

        // adding asss
        return response()->json($model);
    }

    public function editStatus(Request $request)
    {
        $id = $request->id;
        
        
        $model = ModelStatusVerifikasiKtp::where('pasien_id', $id)->update(["status" => 'Sudah Konfirmasi']);
        $pasien = ModelPasien::findOrFail($id);

        $no_handphone = $pasien->no_handphone;
        $substr = substr($no_handphone, 1);

        $phone = '+62'.$substr;

        if($model)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://console.zenziva.net/reguler/api/sendsms/',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('userkey' => '4306ac80483b','passkey' => '2865ade1205108aa0cace78b','to' => $no_handphone,'message' => 'E-Puskesmas - Selamat Akun Anda Telah Terverifikasi'),
            ));
            
            $response = curl_exec($curl); 
            curl_close($curl);

            return response()->json($response);
        }

        
    }

    public function sendNotificationSms()
    {
        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://console.zenziva.net/reguler/api/sendsms/',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('userkey' => '4306ac80483b','passkey' => '2865ade1205108aa0cace78b','to' => '081388669869','message' => 'E-Puskesmas - Selamat Akun Anda Telah Terverifikasi'),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
