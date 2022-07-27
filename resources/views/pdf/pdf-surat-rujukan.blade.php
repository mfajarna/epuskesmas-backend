<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ url('assets/img/logoicon.png') }}">
        <title>{{ config('app.name', 'E-Puskesmas') }}</title>

        <!-- 

        <!-- Scripts -->
                    <!-- Styles -->
        <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css')}}">
                
        <!-- Scripts -->

        <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js')}}"></script>

        <style>
            p#title {
                font-weight:600;
                font-size: 20px;
                margin-bottom: 0;
            }

            p#nama{
                font-weight:800;
                font-size: 23px;
                margin-bottom: 0;
            }

            p#desc{
                margin-bottom: 0;
                font-weight:600;
            }

            p#kartu{
                margin-top: 5px;
                font-size: 15px;
                font-weight:800
            }
        </style>

    </head>
    <body class="bg-light font-sans antialiased bg-light">
        <div class="container my-3">
            <p id="title" class="text-center">PEMERINTAH KABUPATEN KUNINGAN</p>
            <p id="desc" class="text-center">DINAS KESEHATAN</p>
            <p id="nama" class="text-center">UPTD PUSKESMAS LINGGARJATI</p>
            <p id="desc" class="text-center">Jalan Raya Desa Linggarjati Kecamatan Ciliminus</p>
            <p id="desc" class="text-center">KUNINGAN</p>
            <p id="kartu"class="text-center">Kode Pos 45556</p>
        </div>
        <div class="container my-3">
            <p class="text-center"><u>S U R A T   R U J U K A N</u> </p>
            <p class="text-center">No. {{ $data['no_surat'] }}</p>
        </div>
        <div class="container my-3">

        </div>

        <div class="container my-3 justify-content-center ">
            <div class="justify-content-center">
                Yang terhormat dokter ahli Bagian {{ $data['dokter_ahli_bagian']}}, Rumah Sakit {{ $data['nama_rumah_sakit']}}, di {{ $data['di']}}, mohon pemeriksaan pengobatan<br />
                terhadap penderita :<br />
                Nama: {{$pasien->nama_lengkap}} <br />
                Alamat: {{$pasien->alamat}} <br />
                Dengan hasil pemeriksaan sementara sebagai berikut : <br />
                Keterangan Medis: {{ $data['keterangan_medis']}} <br />
                Diagnose: {{ $data['diagnosis']}} <br />
                Keterangan Lain: {{ $data['keterangan_lain']}} <br />
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                    <p class="text-center">Linggarjati, .............. 2022</p> <br>
                    <p class="text-center">Yang Merujuk,</p>
                    <br />
                    <br />
                    <br />
                    <br />
                    <p class="text-center">(...............)</p>
                </div>
            </div>
        </div>

    </body>



    <script>
  
    </script>
</html>