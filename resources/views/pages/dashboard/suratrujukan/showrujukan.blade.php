@extends('layouts.dashboard.app')

@section('title', 'Surat Rujukan')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">List pasien yang telah mengajukan rujukan</h4>
        <p class="card-title-desc">Rekap data setiap pasien yang telah mengajukan rujukan</p>
    </div>
    <div class="card-body">
        <div class="px-2">
            <table id="table-data" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                <thead>
                    <tr role="row">
                        <th class="text-center">Id</th>
                        <th class="text-center">Nama Pasien</th>
                        <th class="text-center">No Surat</th>
                        <th class="text-center">Aksi</th>
                </thead>
            </table>
        </div>
    </div>
</div>



@endsection
@push('after-script')
    <script>
        $(document).ready(function(){
            var t = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                "order" : [
                    [0, "ASC"],
                    [1, "ASC"],
                    [2, "ASC"],

                ],
                ajax:{
                    url: "{{ route('admin.suratrujukan.showRujukan') }}"
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
                        data: "no_surat",
                        name: "no_surat"
                    },

                    {
                        "targets": 3,
                        "class": "text-center",
                        data: 'button_detail',
                        name: 'button_detail',
                        orderable: false
                    },
                ]
            })

            t.on('click', '#lihat_pdf', function(){
                $tr = $(this).closest('tr');

                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent')
                }

                var data = t.row($tr).data();
                var id = data.id;
                var path_pdf = data.path_file_pdf;

                
                window.open('/uploads/'+path_pdf)

            })
        })
    </script>

@endpush