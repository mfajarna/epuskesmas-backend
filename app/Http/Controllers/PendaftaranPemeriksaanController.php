<?php

namespace App\Http\Controllers;

use App\Models\ModelAntrian;
use App\Models\ModelPasien;
use App\Models\ModelPemeriksaan;
use App\Models\ModelStatusVerifikasiKtp;
use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;

class PendaftaranPemeriksaanController extends Controller
{

    protected $auth, $database;

    public function __construct()
    {
        $factory = (new Factory)
                ->withServiceAccount(__DIR__.'/epuskesmas-b4a89-da9b726e9991.json')
                ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();

    }

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



        // Variable's needed
        $id_poli = $request->id_poli;
        $jenis_kunjungan = $request->jenis_kunjungan;
        $jenis_kunjungan_lama = $request->jenis_kunjungan_lama;
        $status = $request->status;
        $id_pasien_lama = $request->id_pasien_lama;
        $no_antrian = $request->no_antrian;
        $nama_dokter = $request->nama_dokter;
        $data = $request->all();   
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


        // Pendaftaran bpjs
        if($status == "bpjs")
        {
            if($jenis_kunjungan == "kunjungan_baru" && $jenis_kunjungan_lama == "")
            {
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
                $pemeriksaan->status_pemeriksaan = "MENUNGGU";
                $pemeriksaan->save();


                // check if verifikasi was added
                $verifikasiKtp = ModelStatusVerifikasiKtp::where('pasien_id', $pasien->id)->first();

                if(!$verifikasiKtp)
                {
                    $modelVerifikasi = new ModelStatusVerifikasiKtp();
                    $modelVerifikasi->pasien_id = $pasien->id;
                    $modelVerifikasi->status ="Belum Upload KTP";
                    $modelVerifikasi->save();
                }
    
                if($user && $pasien && $pemeriksaan && $modelVerifikasi)
                {
                    $creds = [
                        'email' => "yessicajuliane@puskesmas.com",
                        'password' => "Dokter@123",
                    ];
        
                    $createAuth = $this->auth->createUser($creds);
                    $uid = $createAuth->uid;
        
                    $userProperties = [
                        'email' => "yessicajuliane@puskesmas.com",
                        'password' => "Dokter@123",
                        'displayName' => "yesiccajuliane",
                        'uid'   => $uid
                    ];
        
                  
                    $this->database->getReference('/users/'.$uid.'/')->set($userProperties);  


                    toast()->success('Berhasil Membuat Pendaftaran Pemeriksaan Pasien Baru');
        
                    return redirect()->route('admin.pendaftaran-pemeriksaan.index');
                }else{
                    toast()->error('Gagal Membuat Pendaftaran Pemeriksaan Pasien Baru');
        
                    return redirect()->route('admin.pendaftaran-pemeriksaan.index');
                }
            }
    
            if($jenis_kunjungan_lama == "kunjungan_lama")
            {
                $validate = $request->validate([
                    'no_antrian'    => 'required',
                    'tgl_periksa'   => 'required',
                ]);
    
                $pemeriksaan = new ModelPemeriksaan();
                $pemeriksaan->id_pasien = $id_pasien_lama;
                $pemeriksaan->no_urut = $validate['no_antrian'];
                $pemeriksaan->status = $status;
                $pemeriksaan->corrected_by = Auth::user()->id;
                $pemeriksaan->kunjungan = $jenis_kunjungan_lama;
                $pemeriksaan->id_poli = $id_poli;
                $pemeriksaan->status_pemeriksaan = "MENUNGGU";
                $pemeriksaan->save();
    
                if($pemeriksaan)
                {
                    toast()->success('Berhasil Membuat Pendaftaran Pemeriksaan Pasien Lama');
        
                    return redirect()->route('admin.pendaftaran-pemeriksaan.index');
                }else{
                    toast()->error('Gagal Membuat Pendaftaran Pemeriksaan Pasien Lama');
        
                    return redirect()->route('admin.pendaftaran-pemeriksaan.index');
                }
            }
        }

        // Pendaftaran umum
        if($status == "umum")
        {
            if($jenis_kunjungan == "kunjungan_baru" && $request->jenis_kunjungan_lama_umum == "")
            {
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
                $pemeriksaan->status_pemeriksaan = "MENUNGGU";
                $pemeriksaan->save();

                // check if verifikasi was added
                $verifikasiKtp = ModelStatusVerifikasiKtp::where('pasien_id', $pasien->id)->first();

                if(!$verifikasiKtp)
                {
                    $modelVerifikasi = new ModelStatusVerifikasiKtp();
                    $modelVerifikasi->pasien_id = $pasien->id;
                    $modelVerifikasi->status ="Belum Upload KTP";
                    $modelVerifikasi->save();
                }
                    
    
                if($user && $pasien && $pemeriksaan && $modelVerifikasi)
                {

                    $creds = [
                        'email' => "yessicajuliane@puskesmas.com",
                        'password' => "Dokter@123",
                    ];
        
                    $createAuth = $this->auth->createUser($creds);
                    $uid = $createAuth->uid;
        
                    $userProperties = [
                        'email' => "yessicajuliane@puskesmas.com",
                        'password' => "Dokter@123",
                        'displayName' => "yesiccajuliane",
                        'uid'   => $uid
                    ];
        
                  
                    $this->database->getReference('/users/'.$uid.'/')->set($userProperties);  

                    toast()->success('Berhasil Membuat Pendaftaran Pemeriksaan Pasien Baru Umum');
        
                    return redirect()->url('/admin/pendaftaranpemeriksaan');
                }else{
                    toast()->error('Gagal Membuat Pendaftaran Pemeriksaan Pasien Baru Umum');
        
                    return redirect()->url('/admin/pendaftaranpemeriksaan');
                }
            }

            if($request->jenis_kunjungan_lama_umum == "kunjungan_lama")
            {
                $validate = $request->validate([
                    'no_antrian'    => 'required',
                    'tgl_periksa'   => 'required',
                ]);
    
                $pemeriksaan = new ModelPemeriksaan();
                $pemeriksaan->id_pasien = $request->id_pasien_lama_umum;
                $pemeriksaan->no_urut = $validate['no_antrian'];
                $pemeriksaan->status = $status;
                $pemeriksaan->corrected_by = Auth::user()->id;
                $pemeriksaan->kunjungan = $request->jenis_kunjungan_lama_umum;
                $pemeriksaan->id_poli = $id_poli;
                $pemeriksaan->status_pemeriksaan = "MENUNGGU";
                $pemeriksaan->save();
    
                if($pemeriksaan)
                {
                    toast()->success('Berhasil Membuat Pendaftaran Pemeriksaan Pasien Lama Umum');
        
                    return redirect()->route('admin.pendaftaran-pemeriksaan.index');
                }else{
                    toast()->error('Gagal Membuat Pendaftaran Pemeriksaan Pasien Lama Umum');
        
                    return redirect()->route('admin.pendaftaran-pemeriksaan.index');
                }
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
        $find_code = ModelPemeriksaan::where('id_poli', $id_poli)->whereDate('created_at', $date)->max('no_urut');

     
        
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

    public function autocompleteSearch(Request $request)
    {
        $search = $request->search;

        if($search == ''){
           $pasiens = ModelPasien::orderby('no_ktp','asc')->select('id','no_ktp','nama_lengkap','jenis_kelamin','alamat')->limit(5)->get();
        }else{
           $pasiens = ModelPasien::orderby('no_ktp','asc')->select('id','no_ktp','nama_lengkap','jenis_kelamin', 'alamat')->where('no_ktp', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($pasiens as $pasien){
           $response[] = array(
               "value"=>$pasien->no_ktp,
               "label"=>$pasien->no_ktp,
               "jenis_kelamin"  => $pasien->jenis_kelamin,
               "alamat" => $pasien->alamat,
               "id_pasien" => $pasien->id,
               "nama_lengkap" => $pasien->nama_lengkap);
               
        }
  
        return response()->json($response);
    }

    public function regisDokterFbase()
    {
        

            $creds = [
                'email' => "yessicajuliane@puskesmas.com",
                'password' => "Dokter@123",
            ];

            $createAuth = $this->auth->createUser($creds);
            $uid = $createAuth->uid;

            $userProperties = [
                'email' => "yessicajuliane@puskesmas.com",
                'password' => "Dokter@123",
                'displayName' => "yesiccajuliane",
                'uid'   => $uid
            ];

          
            $this->database->getReference('/dokter/'.$uid.'/')->set($userProperties);    

            return response()->json('Sukses');
    }
}
