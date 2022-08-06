<?php

namespace App\Http\Controllers;

use App\Models\ModelUploadKonten;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UploadKontenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ModelUploadKonten::latest()->get();

        if(request()->ajax())
        {
            return DataTables::of($model)->addColumn('action', function($tipe)
            {
                $button = "<div class='d-flex gap-3 align-center'>";

                $button .= "<a href='/admin/delete-informasikesehatan?id=". $tipe->id ."' name='delete' id='" . $tipe->id ."' class='button text-danger'><i class='mdi mdi-delete font-size-18'></i></a>";
                $button .= "<a href='javascript:void(0)' id='btn_update' class='button text-primary'><i class='mdi mdi-pencil font-size-18'></i></a>";

                $button .= "</div>";

                return $button;
            })
            ->addColumn('photo', function($data)
            {
                $elm = "<div class='d-flex gap-3 align-center'>";
                $elm .= '<img src="https://puskeslinggarjati.com/public/uploads/' . $data->path_gambar .'" width="300" height="300   ">';

                $elm .= "</div>";

                return $elm;
            })
            ->rawColumns(['action', 'photo'])
            ->make(true);
        }

        return view('pages.dashboard.uploadkonten.index');
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
            'judul_konten' => 'string|required',
            'deskripsi_konten'    => 'string|required',
            'path_gambar'    => 'required|file:jpg,jpeg,png|max:2048',
        ]);

        $model = new ModelUploadKonten();
        $model->judul_konten = $validate['judul_konten'];
        $model->deskripsi_konten = $validate['deskripsi_konten'];
        
        $image = $request->file('path_gambar');
        $image_name = $image->getClientOriginalName();
        $image->storeAs('images',$image_name, 'public_uploads');
        $image_path = "/images/" . $image_name;

        $model->path_gambar = $image_path;

        $model->save();

        if($model)
        {
            toast()->success('Berhasil Membuat Konten Baru');
        
            return redirect()->route('admin.uploadinformasikesehatan.index');
        }else{
            toast()->error('Gagal Membuat Konten');
        
            return redirect()->route('admin.uploadinformasikesehatan.index');
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

    public function deleteKonten(Request $request)
    {
        $id = $request->id;

        $model = ModelUploadKonten::findOrFail($id);
        $model->delete();

        if($model)
        {
            toast()->success('Berhasil Hapus Konten Baru');
        
            return redirect()->route('admin.uploadinformasikesehatan.index');
        }else{
            toast()->error('Gagal Hapus Konten');
        
            return redirect()->route('admin.uploadinformasikesehatan.index');
        }
    }

    public function getKonten(Request $request)
    {
        $id = $request->id;
        $model = ModelUploadKonten::findOrFail($id);

        return response()->json($model);
    }

    public function updateKonten(Request $request)
    {
        $id = $request->id;
        $model = ModelUploadKonten::findOrFail($id);
        $model->judul_konten = $request->judul_konten;
        $model->deskripsi_konten = $request->deskripsi_konten;

        if($request->hasFile('path_gambar'))
        {
            $image = $request->file('path_gambar');
            $image_name = $image->getClientOriginalName();
            $image->storeAs('images',$image_name, 'public_uploads');
            $image_path = "/images/" . $image_name;
    
            $model->path_gambar = $image_path;
        }
        $model->update();

        if($model)
        {
            toast()->success('Berhasil Update Konten Baru');
        
            return redirect()->route('admin.uploadinformasikesehatan.index');
        }else{
            toast()->error('Gagal Update Konten');
        
            return redirect()->route('admin.uploadinformasikesehatan.index');
        }
    }
}
