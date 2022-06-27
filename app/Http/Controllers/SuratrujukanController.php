<?php

namespace App\Http\Controllers;

use App\Models\ModelHasilPemeriksaan;
use App\Models\ModelPasien;
use App\Models\ModelPemeriksaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function showPdfRujukan()
    {
        return view('pdf.pdf-surat-rujukan');
    }
}
