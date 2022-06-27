@extends('layouts.pdf')

@section('title', 'Riwayat Pasien')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ asset('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Detail Riwayat Pasien</h4>
        <p class="card-title-desc">Rekap data setiap pasien yang mempunyai riwayat berobat</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Pasien</h4>
                        <p class="card-title-desc">Detail profile pasien 
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-lg">
                                <div class="avatar-title bg-soft-primary text-primary display-4 m-0 rounded-circle">
                                    <i class="bx bxs-user-circle"></i>
                                </div>
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-15 mb-1" id="nama_pasien">{!! $nama_lengkap !!}<a href="#" class="text-dark"></a>
                                   
    
                                    
                        <p class="text-muted mb-0">Pasien</p>
                            </div>
                        </div>
                        <div class="mt-3 pt-1">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0" id="nikes"><i class="mdi mdi-format-list-numbered font-size-15 align-middle pe-2 text-primary"></i>
                                        {!! $no_ktp !!}
                                    </p>
                                    <p class="text-muted mb-0 mt-2" id="jenis_kelamin"><i class="mdi mdi-list-status font-size-15 align-middle pe-2 text-primary"></i>
                                        {!! $jenis_kelamin !!}
                                    </p>
    
                                    <p class="text-muted mb-0 mt-2" id="no_telp"><i class="mdi mdi-list-status font-size-15 align-middle pe-2 text-primary"></i>
                                        {!! $no_ktp !!}
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0" id="alamat"><i class="mdi mdi-account-clock font-size-15 align-middle pe-2 text-primary"></i>
                                        {!! $alamat !!}
                                    </p>
    
                                    <p class="text-muted mb-0 mt-2" id="nama_orang_tua"><i class="mdi mdi-account-clock font-size-15 align-middle pe-2 text-primary"></i>
                                        {!! $email !!}
                                    </p>

                                    <p class="text-muted mb-0 mt-2" id="umur"><i class="mdi mdi-account-clock font-size-15 align-middle pe-2 text-primary"></i>
                                        {!! $kode_pasien !!}
                                    </p>
                                </div>

                            </div>
    
                        </div>
                    </div>
    
                </div>
                <!-- end card -->
            </div> 
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Berobat Pasien</h4>
                        <p class="card-title-desc">Data riwayat berobat pasien bedasarkan riwayat pemeriksaan pasien
                        </p>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="id_pasien">    
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="table-view" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                                        <thead>
                                            <tr role="row">
                                                <th class="text-center">Tgl</th>
                                                <th class="text-center">Riwayat Obat</th>
                                                <th class="text-center">Rujukan</th>
                                                <th class="text-center">Keluhan Pasien</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($modelHasilPemeriksaan as $item)
                                                    <tr>
                                                        <td>
                                                            <span class="badge rounded-pill badge-soft-success font-size-11">{{ $item->updated_at }}</span>
                                                        </td>
                                                        <td>
                                                            {{ $item->resep_obat}}
                                                        </td>
                                                        <td>
                                                            {{$item->rujukan}}
                                                        </td>
                                                        <td>
                                                            {{$item->keluhan_pasien}}
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tr>
                                        </tbody>
                
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@push('after-script')
<script>
    window.print();
</script>
@endpush