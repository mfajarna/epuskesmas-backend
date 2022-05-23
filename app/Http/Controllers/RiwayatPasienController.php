<?php

namespace App\Http\Controllers;

use App\Models\ModelHasilPemeriksaan;
use App\Models\ModelPasien;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiwayatPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ModelPasien::with('hasilPemeriksaan')->latest()->get();

        if(request()->ajax())
        {
            return DataTables::of($model)
            ->addColumn('button_detail', function($tipe)
            {
                $button_status = '<button type="button" name="detail" id="detail" class="btn btn-primary btn-rounded waves-effect waves-light w-lg">Detail Pasien</button>';
                

                return $button_status;
            })
            ->rawColumns(['button_detail'])
            ->make(true);
        }

        return view('pages.dashboard.riwayatpasien.index');
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

    public function getPasien(Request $request)
    {
        $id = $request->id;

        $model = ModelPasien::where('id', $id)->first();

        return response()->json($model);
    }

    public function getRiwayatBerobat(Request $request)
    {
        $id = $request->id;

        $model = ModelHasilPemeriksaan::where('id_pasien', $id)->latest()->get();


        if(request()->ajax())
        {
            return DataTables::of($model)
                    ->addColumn('render_tanggal', function($data){
                          $tgl = $data->updated_at;

                          $component = '<span class="badge rounded-pill badge-soft-success font-size-11">' . $tgl .   '</span>';
                        
                          return $component;
                        })
                    ->rawColumns(['render_tanggal'])
                    ->make(true);
        }
    } 
}
