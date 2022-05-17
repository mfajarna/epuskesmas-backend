<?php

namespace App\Http\Controllers;

use App\Models\ModelAntrian;
use App\Models\ModelPasien;
use App\Models\ModelPemeriksaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $find_code = ModelPasien::max('kode_pasien');
        
        if($find_code)
        {
            $value_code = substr($find_code,10);
            $code = (int) $value_code;
            $code = $code + 1;
            $kode_pasien = "PASIEN/".str_pad($code,4,"0",STR_PAD_LEFT);
        }else{
            $kode_pasien = "PASIEN/0001";
        }

        $validate = $request->validate([
            'no_antrian'    => 'required',
            'tgl_periksa'   => 'required',
            'nama_pasien'   => 'required|string',
            'umur'          => 'required|numeric',
            'alamat'        => 'required|string',
            'jenis_kelamin' => 'required|string',
            'no_handphone'  => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'no_ktp'        => 'required|unique:tb_pasien,no_ktp',
        
        ]);

        $id_poli = $request->id_poli;
        $jenis_kunjungan = $request->jenis_kunjungan;
        $status = $request->status;
        $no_antrian = $request->no_antrian;
        $nama_dokter = $request->nama_dokter;

        $data = $request->all();   

        if($jenis_kunjungan == "kunjungan_baru")
        {
            $user = new User();
            $user->name = $validate['nama_pasien'];
            $user->username = $validate['nama_pasien'];
            $user->email = $validate['email'];
            $user->password = Hash::make('Pasien@123');
            $user->created_at = date('Y-m-d h:i:s');
            $user->role = "pasien";
            $user->save();

            $pasien = new ModelPasien();
            $pasien->kode_pasien = $kode_pasien;
            $pasien->nama_lengkap = $validate['nama_pasien'];
            $pasien->alamat = $validate['alamat'];
            $pasien->jenis_kelamin = $validate['jenis_kelamin'];
            $pasien->no_ktp = $validate['no_ktp'];
            $pasien->no_handphone = $validate['no_handphone'];
            $pasien->foto_ktp = null;
            $pasien->is_verification = true;
            $pasien->email = $validate['email'];
            $pasien->password = Hash::make('Pasien@123');
            $pasien->is_active = true;
            $pasien->device_token = "null";
            $pasien->is_verificationktp = false;
            $pasien->save();

            $pemeriksaan = new ModelPemeriksaan();
            $pemeriksaan->id_pasien = $pasien->id;
            $pemeriksaan->umur = $validate['umur'];
            $pemeriksaan->no_urut = $validate['no_antrian'];
            $pemeriksaan->status = $status;
            $pemeriksaan->corrected_by = Auth::user()->id;
            $pemeriksaan->kunjungan = $jenis_kunjungan;
            $pemeriksaan->id_poli = $id_poli;
            $pemeriksaan->save();

            if($user && $pasien && $pemeriksaan)
            {
                toast()->success('Berhasil Membuat Pendaftaran Pemeriksaan Pasien Baru');
    
                return redirect()->route('admin.pendaftaran-pemeriksaan.index');
            }else{
                toast()->error('Gagal Membuat Pendaftaran Pemeriksaan Pasien Baru');
    
                return redirect()->route('admin.pendaftaran-pemeriksaan.index');
            }
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
            $value_code = substr($find_code,2);
            $code = (int) $value_code;
            $code = $code + 1;
            $no_antrian = $namaAntrian . $code;
        }else{
            $no_antrian = $namaAntrian . '1';
        }
        

        return view('pages.dashboard.pendaftaranpemeriksaan.pendaftaran', compact('id_poli', 'nama_poli', 'date', 'nama_dokter','no_antrian'));
    }
}
