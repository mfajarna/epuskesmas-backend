<?php

namespace App\Http\Controllers;

use App\Models\ModelHasilPemeriksaan;
use App\Models\ModelPasien;
use App\Models\ModelPemeriksaan;
use App\Models\ModelSuratRujukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class SuratrujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ModelHasilPemeriksaan::with('pasien')->where('is_rujukan', 1)->latest()->get();

        if(request()->ajax())
        {
            return DataTables::of($model)
            ->addColumn('button_detail', function($tipe)
            {
                $button_status = '<button type="button" name="detail" id="detail" class="btn btn-primary btn-rounded waves-effect waves-light w-lg">Ajukan Rujukan</button>';
                

                return $button_status;
            })
            ->rawColumns(['button_detail'])
            ->make(true);
        }

        return view('pages.dashboard.suratrujukan.index');
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
        $id_pemeriksaan = $request->id_pemeriksaan;
        $pasien = ModelPasien::findOrFail($request->id_pasien);
        $rand_int = rand(1,100);

        $name_file = $request->no_surat . "-PKM-LGJ-2022".$rand_int.".pdf";
        $no_surat = $request->no_surat . "-PKM-LGJ-2022".$rand_int;

        $data = [
            'nama_rumah_sakit'      => $request->nama_rumah_sakit ? $request->nama_rumah_sakit : '',
            'dokter_ahli_bagian'    => $request->dokter_ahli_bagian ? $request->dokter_ahli_bagian : '',
            'di'                    => $request->di ? $request->di : '',
            'keterangan_medis'      => $request->keterangan_medis ? $request->keterangan_medis : '',
            'diagnosis'             => $request->diagnosis ? $request->diagnosis  : '',
            'keterangan_lain'       => $request->keterangan_lain ? $request->keterangan_lain : '',
            'no_surat'              => $no_surat ? $no_surat : ''
        ];

        $pemeriksaan = ModelHasilPemeriksaan::where('id',$id_pemeriksaan)->first();
        $pemeriksaan->is_rujukan = 0;
        $pemeriksaan->rujukan = "Sudah melakukan rujukan";
        $pemeriksaan->update();

        $suratRujukan = new ModelSuratRujukan();
        $suratRujukan->id_pasien = $request->id_pasien; 
        $suratRujukan->name_file = $name_file;
        $suratRujukan->no_surat = $no_surat;


        $pdf = PDF::loadView('pdf.pdf-surat-rujukan', compact('data', 'pasien'));

        Storage::disk('public_uploads')->put('suratrujukan/'.$name_file.'', $pdf->output());

        $suratRujukan->path_file_pdf = 'suratrujukan/'.$name_file;
        $suratRujukan->save();

        if($pemeriksaan && $suratRujukan)
        {
            toast()->success('Berhasil Membuat Surat Rujukan,');
        
            return redirect()->route('admin.suratrujukan.index');
        }else{
            toast()->error('Gagal Membuat Surat Rujukan,');
        
            return redirect()->route('admin.suratrujukan.index');
        }

        // return $pdf->download($nameFile);


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

    public function showPdfRujukan()
    {
        return view('pdf.pdf-surat-rujukan');
    }

    public function showSuratRujukan()
    {
        $model = ModelSuratRujukan::with('pasien')->latest()->get();

        if(request()->ajax())
        {
            return DataTables::of($model)
            ->addColumn('button_detail', function($tipe)
            {

                $button_status = '<div class="btn-group">';   
                $button_status .= '<button type="button" class="btn btn-success">Aksi</button>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-chevron-down"></i>
                </button>';
                
                $button_status .= '<div class="dropdown-menu" style="">
                <a class="dropdown-item" id="download_pdf" href="/admin/download-pdf/'.$tipe->name_file.'">Download PDF</a>
                <a class="dropdown-item" id="lihat_pdf" href="#">Lihat PDF</a>
            </div>';

                $button_status .= '</div>';

                return $button_status;
            })
            ->rawColumns(['button_detail'])
            ->make(true);
        }

        return view('pages.dashboard.suratrujukan.showrujukan');
    }

    public function downloadPDF($files)
    {
        return response()->download(public_path('/uploads/suratrujukan/'. $files));
    }
}
