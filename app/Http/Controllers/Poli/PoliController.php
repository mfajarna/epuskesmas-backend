<?php

namespace App\Http\Controllers\Poli;

use App\Http\Controllers\Controller;
use App\Models\ModelAntrian;
use App\Models\ModelPoli;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ModelPoli::latest()->get();
        

        if(request()->ajax())
        {
            return DataTables::of($model)
                            ->addColumn('action', function($tipe)
                            {
                                $button = "<div class='d-flex gap-3 align-center'>";

                                $button .= "<a href='/admin/remove-poli?id=". $tipe->id ."' name='delete' id='" . $tipe->id ."' class='button text-danger'><i class='mdi mdi-delete font-size-18'></i></a>";

                                $button .= "</div>";

                                return $button;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }


        return view('pages.dashboard.poli.index');
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
        $validate = $request->validate([
            'nama_poli'     => 'required|string',
            'desc_poli'     => 'required|string|max:10000'
        ]);

        $poli = new ModelPoli();
        $poli->nama_poli = $validate['nama_poli'];
        $poli->desc_poli = $validate['desc_poli'];
        $poli->is_active = 1;
        
        $poli->save();

        $antrian = new ModelAntrian();
        $antrian->id_poli = $poli->id;
        $antrian->status = 'non-active';
        $antrian->no_antrian = 0;

        $antrian->save();

        if($poli)
        {
            toast()->success('Berhasil Membuat Data Poli Baru');

            return redirect()->route('admin.poli.index');
        }else{
            toast()->error('Berhasil Membuat Data Poli Baru');

            return redirect()->route('admin.poli.index');
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


    public function delete(Request $request)
    {
        $id = $request->input('id');

        $model = ModelPoli::findOrFail($id);

        $model->delete();

        if($model)
        {
            toast()->success('Berhasil Hapus Data Poli');
            return redirect()->route('admin.poli.index');
        }else{
            toast()->error('Gagal Hapus Data Poli');
            return redirect()->route('admin.poli.index');
        }


    }
}
