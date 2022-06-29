@extends('layouts.dashboard.app')

@section('title', 'Pemeriksaan Dokter')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ asset('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Pemeriksaan Lab</h4>
                <p class="card-title-desc">Kelola Form Pemeriksaan Lab untuk Pasien</p>
            </div>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> - {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endforeach
    
            @endif

            <div class="px-2">
                <form method="POST" action={{ route('admin.pemeriksaanlab.store') }}>
                    @csrf
                    <input type="hidden" name="id_pasien" id="id_pasien_lama" class="form-control" id="validationCustom04" placeholder="Nama Pasien">
                    <div class="row px-2">
                        <div class="col-md-3 mt-2">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom04">No KTP</label>
                                <input type="number" name="no_ktp" id="no_ktp" class="form-control" id="validationCustom04" placeholder="Cari No KTP Pasien...">
                            </div>
                        </div>
    
                        <div class="col-md-3 mt-2">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom04">Nama Pasien</label>
                                <input type="text" name="nama_pasien_lama" id="nama_pasien_lama" class="form-control" id="validationCustom04" placeholder="Umur Pasien" readonly>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom04">Alamat</label>
                               <textarea name="alamat_lama" id="alamat_lama" class="form-control" placeholder="Alamat Pasien" readonly></textarea>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom04">Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin_lama" id="jenis_kelamin_lama" class="form-control" placeholder="Jenis Kelamin" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row px-2">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="example-date-input" class="form-label">Tanggal</label>
                                <input class="form-control" name="tanggal" type="date" value="{{ old('tanggal') }}" id="example-date-input">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom04">No RM.</label>
                                <input type="text" name="no_rm" id="no_rm" class="form-control" placeholder="Jenis Kelamin" value="{{ old('no_rm') }}"></input>
                            </div>
                        </div>
                    </div>

                    <div class="row px-2">
                        <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>Jenis Pemeriksaan: </h5>

                        <div class="col-md-6">

                            <div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Glukosa Sewaktu" type="checkbox" id="formCheck1">
                                    <label class="form-check-label" for="formCheck1">
                                        1. Glukosa Sewaktu
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Glukosa 2 JPP" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        2. Glukosa 2 JPP
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Glukosa Puasa" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        3. Glukosa Puasa
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Kolesterol" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        4. Kolesterol
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Asam Urat" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        5. Asam Urat
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="HB" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        6. HB
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Protein" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        7. Protein
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Golongan Darah" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        8. Golongan Darah
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Test Kehamilan" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        9. Tes Kehamilan
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="Dahak" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        10. Dahak
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="HIV" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        11. HIV
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" name="jenis_pemeriksaan[]" value="HbsAg" type="checkbox" id="formCheck2">
                                    <label class="form-check-label" for="formCheck2">
                                        12. HbsAg
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <button class="btn btn-primary" id="submit" type="submit">Submit Pendaftaran</button>
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</div>


@endsection

@push('after-script')
    <script src="{{url('https://code.jquery.com/ui/1.13.0/jquery-ui.min.js')}}" type="text/javascript"></script>    
    <script>
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
         
         $(document).ready(function() {
            $("#no_ktp").autocomplete({
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

         })
    </script>
@endpush