@extends('layouts.dashboard.app')

@section('title', 'Pemeriksaan Dokter')

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
        <li class="breadcrumb-item"><a href="{{ route('admin.pemeriksaandokter.index') }}">Pemeriksaan Dokter</a></li>
        <li class="breadcrumb-item active">{{$nama_poli}}</li>
    </ol>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">List Pasien {{ $nama_poli }}</h4>
        <p class="card-title-desc">List Pemeriksaan Pasien</p>
    </div>
    <div class="card-body">
        <div class="px-2">
            <table id="table-data" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                <thead>
                    <tr role="row">
                        <th class="text-center">No Antrian</th>
                        <th class="text-center">Nama Pasien</th>
                        <th class="text-center">Status Pendaftaran Pasien</th>
                        <th class="text-center">Status Pemeriksaan</th>
                        <th class="text-center">Aksi</th>
                </thead>
            </table>
        </div>
    </div>
</div>



@endsection

@push('after-script')
    <script>
        $(document).ready(function (){
            var t = $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                "order" : [
                    [0, "ASC"],
                    [1, "ASC"],
                    [2, "ASC"],
                    [3, "ASC"],
                ],
                ajax:{
                    url: "{{ url('admin/pemeriksaandokter/pemeriksaan/'. $id_poli . '/'. $nama_poli) }}"
                },
                columnDefs:[
                    {targets:'_all', visible: true},
                    {
                        "targets": 0,
                        "class": "text-sm",
                        data: "no_urut",
                        name: "no_urut"
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
                        data: "status",
                        name: "status"
                    },
                    {
                        "targets": 3,
                        "class": "text-sm",
                        data: "status_pemeriksaan",
                        name: "status_pemeriksaan"
                    },
                    {
                        "targets": 4,
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

                var route = "{{ url('admin/datapemeriksaan/') }}" + "/"+id

                return window.location.href = route;
            })
        })
    </script>
@endpush