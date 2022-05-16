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
                        <form method="POST" action={{ route('admin.pendaftaran-pemeriksaan.store') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">No Urut</label>
                                        <input type="text" name="no_antrian" class="form-control" id="validationCustom01" placeholder="No Urut" required="" value="{{ $no_antrian }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">Tanggal Periksa</label>
                                        <input type="text" name="tgl_periksa" class="form-control" id="validationCustom02" placeholder="Tanggal" value="{{ $date }}" required disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="validationCustom04" value="bpjs" placeholder="status" required="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom04">Nama Dokter</label>
                                        <input type="text" name="nama_dokter" class="form-control" id="validationCustom04" value="{{ $nama_dokter }}" placeholder="Nama Dokter" required="" disabled>
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
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Nama Pasien</label>
                                                        <input type="text" class="form-control" id="validationCustom04" placeholder="Nama Pasien" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Umur</label>
                                                        <input type="number" class="form-control" id="validationCustom04" placeholder="Umur Pasien" required>
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
                                                        <select class="form-select">
                                                            <option>Laki-Laki</option>
                                                            <option>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">No Handphone</label>
                                                        <input type="number" name="no_handphone" class="form-control" id="validationCustom04" placeholder="No Handphone" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">Email</label>
                                                        <input type="email" name="email" class="form-control" id="validationCustom04" placeholder="Email" required>
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
                    <div class="tab-pane" id="messages1" role="tabpanel">
                        <p class="mb-0">
                            Etsy mixtape wayfarers, ethical wes anderson tofu before they
                            sold out mcsweeney's organic lomo retro fanny pack lo-fi
                            farm-to-table readymade. Messenger bag gentrify pitchfork
                            tattooed craft beer, iphone skateboard locavore carles etsy
                            salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                            Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                            mi whatever gluten-free carles.
                        </p>
                    </div>
                    <div class="tab-pane" id="settings1" role="tabpanel">
                        <p class="mb-0">
                            Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                            art party before they sold out master cleanse gluten-free squid
                            scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                            art party locavore wolf cliche high life echo park Austin. Cred
                            vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                            farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                            mustache readymade keffiyeh craft.
                        </p>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div>

@endsection