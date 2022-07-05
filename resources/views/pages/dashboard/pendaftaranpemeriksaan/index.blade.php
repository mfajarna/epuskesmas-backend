@extends('layouts.dashboard.app')

@section('title', 'Pendaftaran Pasien')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')

<div class="row">
    <div class="col-xl-12">
        <h5 class="card-title">List Poli<span class="text-muted fw-normal ms-2">({{ $antrianPoliCount }})</span></h5>
        <div class="row">
            @foreach ($antrianPoli as $data)
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="dropdown text-end">

                            </div>
                            
                            <div class="mx-auto mb-2">
                                <h2 class="mb-sm-0">PG</h2>
                            </div>
                            <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">({{$data->poli->nama_poli}})</a></h5>                        
                        </div>

                        <div class="btn-group" role="group">
                            <a href="{{ url('admin/pendaftaranpemeriksaanpasien/pendaftaran/'. $data->id . '/'. $data->poli->nama_poli) }}"class="btn btn-outline-primary text-truncate"><i class="uil uil-user me-1"></i>Pilih Poli</a>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection