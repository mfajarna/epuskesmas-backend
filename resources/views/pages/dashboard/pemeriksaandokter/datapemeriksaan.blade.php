@extends('layouts.dashboard.app')

@section('title', 'Pemeriksaan Pasien')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ asset('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{asset('https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css')}}">
@endpush


@section('content')
<div class="page-title-right">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.pemeriksaandokter.index') }}">Pemeriksaan Dokter</a></li>
        <li class="breadcrumb-item active">Pemeriksaan pasien {{ $nama_pasien }}</li>
    </ol>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data pemeriksaan pasien {{ $nama_pasien }}</h4>
        <p class="card-title-desc">Harap isi data sesuai dengan hasil pemeriksaan</p>
    </div>

    <div class="card-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> - {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endforeach

        @endif

        <form method="POST" action={{ route('admin.pemeriksaandokter.store') }}>
            @csrf
            <input type="hidden" name="id_pemeriksaan" class="form-control" id="validationCustom01" value="{{ $id }}" placeholder="No Antrian"  readonly>
            <input type="hidden" name="id_pasien" class="form-control" id="validationCustom01" value="{{ $id_pasien }}" placeholder="No Antrian"  readonly>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label" for="validationCustom01">No Antrian</label>
                        <input type="text" name="no_antrian" class="form-control" id="validationCustom01" value="{{ $no_antrian }}" placeholder="No Antrian"  readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label" for="validationCustom02">Tanggal Periksa</label>
                        <input type="text" name="tgl_periksa" class="form-control" id="validationCustom02" placeholder="Tanggal" value="{{ $tanggal_periksa }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label" for="validationCustom02">Jenis Kunjungan</label>
                        <input type="text" name="tgl_periksa" class="form-control" id="validationCustom02" placeholder="Tanggal" value="{{ $jenis_kunjungan }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" id="validationCustom04" value="{{ $status }}" placeholder="status" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom04">Nama Dokter</label>
                        <input type="text" name="nama_dokter" class="form-control" id="validationCustom04" placeholder="Nama Dokter" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom04">Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" id="validationCustom04" placeholder="Nama Pasien" value="{{ $nama_pasien }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom04">Alamat</label>
                       <textarea name="alamat" class="form-control" placeholder="Alamat Pasien" readonly>{{ $alamat }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom04">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" id="validationCustom04" placeholder="Jenis Kelamin" value="{{ $jenis_kelamin }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="row">
  

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom04">Keluhan Pasien</label>
                                   <textarea name="keluhan_pasien" class="form-control" placeholder="Resep Obat"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom04">Resep Obat</label>
                                   <textarea name="resep_obat" class="form-control" placeholder="Resep Obat"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input class="form-check-input" name="rujukan_check" type="checkbox" id="autoSizingCheck2">
                                    <label class="form-check-label" for="autoSizingCheck2">
                                        Butuh Rujukan
                                    </label>
                                </div>
                            </div>
  

                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="multi-collapse collapse" id="multiCollapseExample1" style="">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom04">Rujukan Pasien</label>
                                            <textarea name="rujukan" class="form-control" placeholder="Rujukan Pasien"></textarea>
                                            <div class="text-muted">*Kosongkan jika tidak memperlukan rujukan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                
            </div>
            <button class="btn btn-primary" type="submit">Submit Pemeriksaan</button>
        </form>
    </div>
</div>
@endsection


@push('after-script')
    
@endpush