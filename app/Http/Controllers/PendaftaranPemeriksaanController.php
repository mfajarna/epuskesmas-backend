<?php

namespace App\Http\Controllers;

use App\Models\ModelAntrian;
use App\Models\ModelPemeriksaan;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranPemeriksaanController extends Controller
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


        return view('pages.dashboard.pendaftaranpemeriksaan.index', compact('antrianPoli', 'antrianPoliCount'));
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

    public function pendaftaran($id_poli, $nama_poli)
    {
        $dokter = User::where('role', 'dokter')->first(); 
        $nama_dokter = $dokter->name;
        $date = date('Y-m-d');

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
        $find_code = ModelPemeriksaan::max('no_urut');
        
        if($find_code)
        {
            $value_code = substr($find_code,10);
            $code = (int) $value_code;
            $code = $code + 1;
            $no_antrian = $namaAntrian . $code;
        }else{
            $no_antrian = $namaAntrian . '1';
        }
        

        return view('pages.dashboard.pendaftaranpemeriksaan.pendaftaran', compact('id_poli', 'nama_poli', 'date', 'nama_dokter','no_antrian'));
    }
}
