@extends('layouts.dashboard.app')

@section('title', 'Pendaftaran Pasien')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{url('https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css')}}">
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
                                                        <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" id="validationCustom04"  placeholder="Nama Pasien">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Umur</label>
                                                        <input type="number" name="umur" value="{{ old('umur') }}" class="form-control" id="validationCustom04"  placeholder="Umur Pasien">
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
                                                        <input type="number" name="no_ktp" value="{{ old('no_ktp') }}" class="form-control" id="validationCustom04" placeholder="No Ktp">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Email</label>
                                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="validationCustom04" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No Handphone</label>
                                                        <input type="number" name="no_handphone" value="{{ old('no_handphone') }}" class="form-control" id="validationCustom04" placeholder="No Handphone">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile3" role="tabpanel">
                                            <div class="row">
                                                <input type="hidden" name="jenis_kunjungan_lama" id="jenis_kunjungan_lama" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                                                <input type="hidden" name="id_pasien_lama" id="id_pasien_lama" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No KTP</label>
                                                        <input type="number" name="no_ktp_lama" id="no_ktp_lama" value="{{ old('no_ktp_lama') }}" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Nama Pasien</label>
                                                        <input type="text" name="nama_pasien_lama" id="nama_pasien_lama" value="{{ old('nama_pasien_lama') }}" class="form-control" id="validationCustom04" placeholder="Umur Pasien" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Alamat</label>
                                                       <textarea name="alamat_lama" id="alamat_lama" class="form-control" placeholder="Alamat Pasien" readonly></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Jenis Kelamin</label>
                                                       <textarea name="jenis_kelamin_lama" id="jenis_kelamin_lama" class="form-control" placeholder="Alamat Pasien" readonly></textarea>
                                                    </div>
                                                </div>
                                            </div> 
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
                                        <input type="text" name="status" class="form-control" id="validationCustom04" value="umum" placeholder="status" readonly>
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
                                                <a class="nav-link active" data-bs-toggle="tab" href="#kunjungan_baru" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Kunjungan Baru</span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#kunjungan_lama" role="tab" aria-selected="false">
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
                                        <div class="tab-pane active" id="kunjungan_baru" role="tabpanel">
                                            <input type="hidden" name="jenis_kunjungan" value="kunjungan_baru" class="form-control" id="validationCustom04" placeholder="Nama Pasien" required>
                                            <input type="hidden" name="id_poli" value="{{ $id_poli }}" class="form-control" id="validationCustom04" placeholder="Nama Pasien" required>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Nama Pasien</label>
                                                        <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" id="validationCustom04"  placeholder="Nama Pasien">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Umur</label>
                                                        <input type="number" name="umur" value="{{ old('umur') }}" class="form-control" id="validationCustom04"  placeholder="Umur Pasien">
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
                                                        <input type="number" name="no_ktp" value="{{ old('no_ktp') }}" class="form-control" id="validationCustom04" placeholder="No Ktp">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Email</label>
                                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="validationCustom04" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No Handphone</label>
                                                        <input type="number" name="no_handphone" value="{{ old('no_handphone') }}" class="form-control" id="validationCustom04" placeholder="No Handphone">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="kunjungan_lama" role="tabpanel">
                                            <div class="row">
                                                
                                                <input type="hidden" name="jenis_kunjungan_lama_umum" id="jenis_kunjungan_lama_umum" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                                                <input type="hidden" name="id_pasien_lama_umum" id="id_pasien_lama_umum" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No KTP</label>
                                                        <input type="number" name="no_ktp_lama_umum" id="no_ktp_lama_umum" value="{{ old('no_ktp_lama_umum') }}" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Nama Pasien</label>
                                                        <input type="text" name="nama_pasien_lama_umum" id="nama_pasien_lama_umum" value="{{ old('nama_pasien_lama_umum') }}" class="form-control" id="validationCustom04" placeholder="Umur Pasien" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Alamat</label>
                                                       <textarea name="alamat_lama_umum" id="alamat_lama_umum" class="form-control" placeholder="Alamat Pasien" readonly></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Jenis Kelamin</label>
                                                       <textarea name="jenis_kelamin_lama_umum" id="jenis_kelamin_lama_umum" class="form-control" placeholder="Alamat Pasien" readonly></textarea>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div>


                            <button class="btn btn-primary" type="submit">Submit Pendaftaran</button>
                        </form>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div>

@endsection

@push('after-script')
    <script src="{{asset('https://code.jquery.com/ui/1.13.0/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){

        $("#no_ktp_lama").autocomplete({
            source: function( request, response ) {
            // Fetch data
            $.ajax({
                url:"{{route('admin.autocomplete.pasien')}}",
                type: 'post',
                dataType: "json",
                data: {
                _token: CSRF_TOKEN,
                search: request.term
                },
                success: function( data ) {
                response( data );
                }
            });
            },
            select: function (event, ui) {
            // Set selection
            $('#no_ktp_lama').val(ui.item.label); // display the selected text
            $('#nama_pasien_lama').val(ui.item.nama_lengkap); // save selected id to input
            $('#alamat_lama').val(ui.item.alamat);
            $('#jenis_kelamin_lama').val(ui.item.jenis_kelamin);
            $('#jenis_kunjungan_lama').val("kunjungan_lama");
            $('#id_pasien_lama').val(ui.item.id_pasien);

            return false;
            }
        });

        $("#no_ktp_lama_umum").autocomplete({
            source: function( request, response ) {
            // Fetch data
            $.ajax({
                url:"{{route('admin.autocomplete.pasien')}}",
                type: 'post',
                dataType: "json",
                data: {
                _token: CSRF_TOKEN,
                search: request.term
                },
                success: function( data ) {
                response( data );
                }
            });
            },
            select: function (event, ui) {
            // Set selection
            $('#no_ktp_lama_umum').val(ui.item.label); // display the selected text
            $('#nama_pasien_lama_umum').val(ui.item.nama_lengkap); // save selected id to input
            $('#alamat_lama_umum').val(ui.item.alamat);
            $('#jenis_kelamin_lama_umum').val(ui.item.jenis_kelamin);
            $('#jenis_kunjungan_lama_umum').val("kunjungan_lama");
            $('#id_pasien_lama_umum').val(ui.item.id_pasien);

            return false;
            }
        });

        });
    </script>
@endpush