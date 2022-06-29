@extends('layouts.dashboard.app')

@section('title', 'Verifikasi KTP')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')

@include('modal.ktp.index')
    
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Konfirmasi KTP</h4>
                <p class="card-title-desc">Kelola validasi status ktp</p>
            </div>


            <div class="px-2">
                <table id="table-data" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                    <thead>
                        <tr role="row">
                            <th class="text-center">Id</th>
                            <th class="text-center">Nama Pasien</th>
                            <th class="text-center">No KTP</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Waktu Upload</th>
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
                    [3, "ASC"]
                ],
                ajax:{
                    url: "{{ route('admin.verifikasiktp.index') }}"
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
                        data: "pasien.nama_lengkap",
                        name: "pasien.nama_lengkap"
                    },
                    {
                        "targets": 2,
                        "class": "text-sm",
                        data: "pasien.no_ktp",
                        name: "pasien.no_ktp"
                    },
                    {
                        "targets":3,
                        "class": "text-center",
                        data: "status_button",
                        name: "status_button",
                    },
                    {
                        "targets": 4,
                        "class": "text-center",
                        data: "waktu_upload",
                        name: "waktu_upload",
                        orderable: false
                    },
                    {
                        "targets": 5,
                        "class": "text-center",
                        data: 'button_detail',
                        name: 'button_detail',
                        orderable: false
                    }
                ]
            })

            t.on('click', '#detail', function(){

                $tr = $(this).closest('tr');
                        if($($tr).hasClass('child')){
                            $tr = $tr.prev('.parent')
                        }

                    var data = t.row($tr).data();
                    var id = data.id;

                $('#ModalView').modal('show')


                $.ajax({
                    method: 'get',
                    url: '{{ route("admin.ktp.detail") }}',
                    data: {id:id},
                    success: function(res)
                    {
                        console.log('res detail ktp', res);
                        $("#img_ktp").attr("src", res[0].pasien.foto_ktp)
                        $("#no_ktp").text(res[0].pasien.no_ktp)
                    }
                })
            })


            t.on('click', '#status_ktp', function(){
                $tr = $(this).closest('tr');
                        if($($tr).hasClass('child')){
                            $tr = $tr.prev('.parent')
                        }

                    var data = t.row($tr).data();
                    var id = data.pasien.id;
                    
                    $.ajax({
                    method: 'get',
                    url: '{{ route("admin.ktp.editstatus") }}',
                    data: {id:id},
                    success: function(res)
                    {
                        $('#table-data').DataTable().ajax.reload();
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