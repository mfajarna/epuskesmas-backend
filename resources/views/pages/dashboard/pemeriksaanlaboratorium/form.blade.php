<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{'E-Puskesmas' }}</title>

        <!-- Fonts -->


        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css')}}">
                
        <!-- Scripts -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
     
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
            <p class="text-center">FORMULIR PERMINTAAN PEMERIKSAAN LABORATORIUM </p>
        </div>
        <div class="container my-3">
            <div class="row">
                <div class="col-md-6">
                    <p>Nama Pasien : {!! $modelPasien->nama_lengkap !!}</p>
                    <p>Alamat : {!! $modelPasien->alamat !!}</p>
                    <p>Jenis Kelamin : {!! $modelPasien->jenis_kelamin !!}</p>
                </div>
                <div class="col-md-6">
                    <p>Tanggal : {!! $model->tanggal !!}</p>
                    <p>No RM : {!! $model->no_rm !!}</p>
                </div>
            </div>

        </div>

        <div class="container my-3 justify-content-center ">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Pemeriksaan</th>
                  </tr>
                </thead>
                <tbody>
               
                    @foreach ($model->jenis_pemeriksaan as $key => $val)
                    <tr>
                        <td>{{ $key+1 }}</td> 
                        <td>{{ $val }}</td>
                    </tr>
                    @endforeach
               

                </tbody>
              </table>
        </div>

    </body>
    <footer>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                    Kuningan, .... <br>
                    <p class="text-center">Pengirim,</p>
                    <br />
                    <br />
                    <br />
                    <br />
                    <p class="text-center">(...............)</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
  
    </script>
</html>