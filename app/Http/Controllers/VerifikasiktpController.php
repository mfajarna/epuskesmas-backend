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
            Nexmo::message()->send([
                'to'        => $phone,
                'from'      => 'Epuskesmas Apps',
                'sender'    => 'Epuskesmas Apps',
                'text'      => 'Epuskesmas Apps - Selamat KTP Anda telah diverifikasi'
            ]);

            return response()->json($model);
            // return toast()->success('Berhasil update status KTP');
        }

        
    }

    public function sendNotificationSms()
    {
        try{
            Nexmo::message()->send([
                'to'        => '+6281388669869',
                'from'      => 'Epuskesmas Apps',
                'sender'    => 'Epuskesmas Apps',
                'text'      => 'Test Message'
            ]);
    
        echo "Text Send";
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
