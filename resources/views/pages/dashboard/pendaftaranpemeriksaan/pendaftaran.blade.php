@extends('layouts.dashboard.app')

@section('title', 'Pendaftaran Pasien')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ asset('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')

<div class="page-title-right">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.pendaftaran-pemeriksaan.index') }}">Pendaftaran Pemeriksaan</a></li>
        <li class="breadcrumb-item active">{{$nama_poli}}</li>
    </ol>
</div>

       <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pendaftaran Pemeriksaan</h4>
                <p class="card-title-desc">Pendaftaran pemeriksaan menggunakan bpjs dan non-bpjs pada pilihan dibawah!</p>
            </div><!-- end card header -->
            
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Pendaftaran BPJS</span> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Pendaftaran Umum</span> 
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home1" role="tabpanel">

                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> - {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        @endforeach

                        @endif
                        <form method="POST" action={{ route('admin.pendaftaran-pemeriksaan.store') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">No Urut</label>
                                        <input type="text" name="no_antrian" class="form-control" id="validationCustom01" placeholder="No Urut" value="{{ $no_antrian }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">Tanggal Periksa</label>
                                        <input type="text" name="tgl_periksa" class="form-control" id="validationCustom02" placeholder="Tanggal" value="{{ $date }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="validationCustom04" value="bpjs" placeholder="status" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Nama Dokter</label>
                                        <input type="text" name="nama_dokter" class="form-control" id="validationCustom04" value="{{ $nama_dokter }}" placeholder="Nama Dokter" required="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Data Pasien</h4>
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-pills card-header-pills" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home3" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Kunjungan Baru</span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile3" role="tab" aria-selected="false">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Kunjungan Lama</span> 
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- end card header -->
                                
                                <div class="card-body">
                                   
                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="home3" role="tabpanel">
                                            <input type="hidden" name="jenis_kunjungan" value="kunjungan_baru" class="form-control" id="validationCustom04" placeholder="Nama Pasien" required>
                                            <input type="hidden" name="id_poli" value="{{ $id_poli }}" class="form-control" id="validationCustom04" placeholder="Nama Pasien" required>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Nama Pasien</label>
                                                        <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" id="validationCustom04" placeholder="Nama Pasien" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Umur</label>
                                                        <input type="number" name="umur" value="{{ old('umur') }}" class="form-control" id="validationCustom04" placeholder="Umur Pasien" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Alamat</label>
                                                       <textarea name="alamat" class="form-control" placeholder="Alamat Pasien"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-select">
                                                            <option value="laki-laki">Laki-Laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No KTP</label>
                                                        <input type="number" name="no_ktp" value="{{ old('no_ktp') }}" class="form-control" id="validationCustom04" placeholder="No Ktp" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Email</label>
                                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="validationCustom04" placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No Handphone</label>
                                                        <input type="number" name="no_handphone" value="{{ old('no_handphone') }}" class="form-control" id="validationCustom04" placeholder="No Handphone" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile3" role="tabpanel">
                                            <p class="mb-0">
                                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                                single-origin coffee squid. Exercitation +1 labore velit, blog
                                                sartorial PBR leggings next level wes anderson artisan four loko
                                                farm-to-table craft beer twee. Qui photo booth letterpress,
                                                commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                                vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                                aesthetic magna delectus.
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div>

                            <button class="btn btn-primary" type="submit">Submit Pendaftaran</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <form method="POST" action={{ route('admin.pendaftaran-pemeriksaan.store') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">No Urut</label>
                                        <input type="text" name="no_antrian" class="form-control" id="validationCustom01" placeholder="No Urut" required="" value="{{ $no_antrian }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">Tanggal Periksa</label>
                                        <input type="text" name="tgl_periksa" class="form-control" id="validationCustom02" placeholder="Tanggal" value="{{ $date }}" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="validationCustom04" value="bpjs" placeholder="status" required="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Nama Dokter</label>
                                        <input type="text" name="nama_dokter" class="form-control" id="validationCustom04" value="{{ $nama_dokter }}" placeholder="Nama Dokter" required="" readonly>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary" type="submit">Submit Pendaftaran</button>
                        </form>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div>

@endsection