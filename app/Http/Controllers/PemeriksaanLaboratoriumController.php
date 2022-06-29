<?php

namespace App\Http\Controllers;

use App\Models\ModelPasien;
use App\Models\ModelPemeriksaanlab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class PemeriksaanLaboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.pemeriksaanlaboratorium.index');
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
        $validation = $request->validate([
            'id_pasien'         => 'required',
            'jenis_pemeriksaan' =>  'required',
            'tanggal'           => 'required|date',
            'no_rm'             => 'required' 
        ]);

        $nameFile =  $request->tanggal . $validation['no_rm'] . "permintaan_pemeriksaan_lab_" . $request->nama_pasien_lama. ".pdf";
        $model = new ModelPemeriksaanlab();
        $model->id_user = $validation['id_pasien'];
        $model->tanggal = $validation['tanggal'];
        $model->no_rm = $validation['no_rm'];
        $model->jenis_pemeriksaan = $validation['jenis_pemeriksaan'];
        $model->save();

        $modelPasien = ModelPasien::findOrFail($validation['id_pasien']);
          
        $pdf = PDF::loadView('pages.dashboard.pemeriksaanlaboratorium.form', compact('model', 'modelPasien'));
        Storage::put('public/pdf/'.$nameFile.'', $pdf->output());
    
        return $pdf->download($nameFile);
        
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

    public function printFormulirPemeriksaanLab($id)
    {

        return view('pages.dashboard.pemeriksaanlaboratorium.form');
    }
}
