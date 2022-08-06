@extends('layouts.dashboard.app')

@section('title', 'Upload Konten Informasi Kesehatan')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')

@include('modal.uploadkonten.index')
@include('modal.uploadkonten.update')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manajemen Konten</h4>
                    <p class="card-title-desc">Kelola konten informasi kesehatan Poli pada puskesmas</p>
                </div>

                <div class="card-body">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#ModalView"><i class="bx bx-add-to-queue label-icon"></i>Tambah</button>
                </div>

                <div class="px-2">
                    <table id="table-data" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                        <thead>
                            <tr role="row">
                                <th class="text-center">Id</th>
                                <th class="text-center">Judul Konten</th>
                                <th class="text-center">Deskripsi Konten</th>
                                <th class="text-center">Gambar Konten</th>
                                <th class="text-center">Aksi</th>
                        </thead>

                    </table>
                </div>
                
            </div>
        </div>
</div>

@endsection

@push('after-script')

<script>
        $(document).ready(function() {
            var t = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                "order" : [
                    [0, "ASC"],
                    [1, "ASC"],
                    [2, "ASC"],
                ],
                ajax:{
                    url: "{{ route('admin.uploadinformasikesehatan.index') }}"
                },
                columnDefs:[
                    {targets:'_all', visible: true},
                    {
                        "targets": 0,
                        "class": "text-sm",
                        data: "id",
                        name: "id"
                    },
                    {
                        "targets": 1,
                        "class": "text-sm",
                        data: "judul_konten",
                        name: "judul_konten"
                    },
                    {
                        "targets": 2,
                        "class": "text-sm",
                        data: "deskripsi_konten",
                        name: "deskripsi_konten"
                    },
                    {
                        "targets": 3,
                        "class": "text-sm",
                        data: "photo",
                        name: "photo",
                    },
                    {
                        "targets": 4,
                        "class": "text-sm",
                        data: "action",
                        name: "action",
                        orderable: false
                    }
                ]
            })

            t.on('click', '#btn_update', function()
            {
                $('#ModalViewUpdate').modal('show');
                $tr = $(this).closest('tr')
                    if($($tr).hasClass('child'))
                    {
                            $tr = $tr.prev('.parent')
                    }
                    
                    var data = t.row($tr).data();
                    var id = data.id;

                    $.ajax({
                        method: 'get',
                        url: '{{ route("admin.uploadinformasikesehatan.getKonten") }}',
                        data: {id:id},
                        success: function(res){
                                $('#id').val(res.id);
                                $('#judul_konten_update').val(res.judul_konten);
                                $('textarea#deskripsi_konten_update').val(res.deskripsi_konten);
                        }
                    })
            })
        
        })




        function closeModal()
                {
                    $('#ModalView').modal('hide');
                }
    </script>


@endpush