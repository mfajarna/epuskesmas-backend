<?php

namespace App\Http\Controllers;

use App\Models\ModelAntrian;
use App\Models\ModelHasilPemeriksaan;
use App\Models\ModelPemeriksaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PemeriksaanDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antrianPoli = ModelAntrian::with('poli')->where('status', 'active')->get();
        $antrianPoliCount = ModelAntrian::where('status', 'active')->count();

        return view('pages.dashboard.pemeriksaandokter.index', compact('antrianPoli', 'antrianPoliCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validation = $request->validate([
            'id_pemeriksaan'    => 'required',
            'id_pasien'         => 'required',
        ]);

        $rujukan = $request->rujukan;

        $model = new ModelHasilPemeriksaan();
        $model->id_pemeriksaan = $validation['id_pemeriksaan'];
        $model->id_pasien = $validation['id_pasien'];
        if($rujukan == "")
        {
            $model->is_rujukan = 0;
            $model->rujukan = "";
        }
        if($rujukan != "")
        {
            $model->is_rujukan = 1;
            $model->rujukan =$rujukan;
        }
        $model->resep_obat = $request->resep_obat;
        $model->save();

        $pemeriksaan = ModelPemeriksaan::findOrFail($validation['id_pemeriksaan']);
        $pemeriksaan->status_pemeriksaan = "SELESAI";
        $pemeriksaan->save();

        if($model && $pemeriksaan)
        {
            toast()->success('Berhasil membuat hasil pemeriksaan pasien');
        
            return redirect()->route('admin.pemeriksaandokter.index');
        }else{
            toast()->error('Gagal membuat hasil pemeriksaan pasien');
        
            return redirect()->route('admin.pemeriksaandokter.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
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
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public function pemeriksaan($id_poli, $nama_poli)
    {
        $model = ModelPemeriksaan::with('pasien')->where('id_poli', $id_poli)->where('status_pemeriksaan', 'MENUNGGU')->get();

        if(request()->ajax())
        {
            return DataTables::of($model)
            ->addColumn('button_detail', function($tipe)
            {
                $button_status = '<button type="button" name="detail" id="detail" class="btn btn-primary btn-rounded waves-effect waves-light w-lg">Mulai Periksa</button>';
                

                return $button_status;
            })
            ->rawColumns(['button_detail'])
            ->make(true);
        }

        return view('pages.dashboard.pemeriksaandokter.pemeriksaan', compact('id_poli','nama_poli'));
    }

    public function dataPemeriksaan($id)
    {
        $model = ModelPemeriksaan::with('pasien')->findOrFail($id);
        $id_pasien = $model['pasien']['id'];
        $nama_pasien = $model['pasien']['nama_lengkap'];
        $no_antrian = $model['no_urut'];
        $tanggal_periksa = $model['created_at'];
        $status = $model['status'];
        $alamat = $model['pasien']['alamat'];
        $jenis_kelamin = $model['pasien']['jenis_kelamin'];
        $jenis_kunjungan = $model['kunjungan'];

        return view('pages.dashboard.pemeriksaandokter.datapemeriksaan', compact('id','id_pasien','nama_pasien','no_antrian', 'tanggal_periksa', 'status', 'alamat', 'jenis_kelamin', 'jenis_kunjungan'));
    }


}
