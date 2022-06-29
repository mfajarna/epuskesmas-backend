@extends('layouts.dashboard.app')

@section('title', 'Riwayat Pasien')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')

@include('modal.riwayatpasien.index')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">List pasien yang telah berobat</h4>
        <p class="card-title-desc">Rekap data setiap pasien yang mempunyai riwayat berobat</p>
    </div>
    <div class="card-body">
        <div class="px-2">
            <table id="table-data" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                <thead>
                    <tr role="row">
                        <th class="text-center">Id</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nama Pasien</th>
                        <th class="text-center">No KTP</th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Print PDF</th>
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
                    [3, "ASC"],
                ],
                ajax:{
                    url: "{{ route('admin.riwayatpasien.index') }}"
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
                        data: "email",
                        name: "email"
                    },
                    {
                        "targets": 2,
                        "class": "text-sm",
                        data: "nama_lengkap",
                        name: "nama_lengkap"
                    },
                    {
                        "targets": 3,
                        "class": "text-sm",
                        data: "no_ktp",
                        name: "no_ktp"
                    },
                    {
                        "targets": 4,
                        "class": "text-center",
                        data: 'button_detail',
                        name: 'button_detail',
                        orderable: false
                    },
                    {
                        "targets": 5,
                        "class": "text-center",
                        data: 'pdf',
                        name: 'pdf',
                        orderable: false
                    }

                ]
            })

            t.on('click', '#pdf', function(){
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent')
                }

                var data = t.row($tr).data();
                var id = data.id;


                window.open('/admin/pdf-riwayat-pasien?id='+id+'', '_blank');


            })


            t.on('click', '#detail', function(){
                $('#ModalView').modal('show');

                $tr = $(this).closest('tr');

                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent')
                }

                var data = t.row($tr).data();
                var id = data.id;
                

                $.ajax({
                    method: 'get',
                    url: '{{ route("admin.riwayatpasien.getpasien") }}',
                    data: {id:id},
                    success: function(res){
                            console.log(res)


                            $('#nama_pasien').text(res.nama_lengkap)
                            $('#nikes').text("No KTP: " + res.no_ktp)
                            $('#jenis_kelamin').text("Jenis Kelamin: " + res.jenis_kelamin)
                            $('#no_telp').text("No Telepon: " + res.no_handphone)
                            $('#alamat').text("Email: " + res.email)
                            $('#nama_orang_tua').text("Alamat " + res.alamat)
                            $('#umur').text("Kode Pasien: " + res.kode_pasien)
                            $('#id_pasien').val(res.id)
                            
                        }
                    })

                    var ts = $('#table-view').DataTable({
                                processing: true,
                                serverSide: true,
                                "order": [
                                        
                                        [1, "ASC"],
                                        [2, "ASC"]
                                ],
                                ajax: {
                                        url: "{{ route('admin.riwayatpasien.getriwayat') }}",
                                        data: {id:id}
                                },
                                columnDefs: [
                                        {targets:'_all', visible: true},
                                        {
                                                "targets": 0,
                                                "class": "text-sm",
                                                data: "render_tanggal",
                                                name: "render_tanggal",
                                        },
                                        {
                                                "targets": 1,
                                                "class": "text-sm",
                                                data: "resep_obat",
                                                name: "resep_obat"
                                        },
                                        {
                                                "targets": 2,
                                                "class": "text-sm",
                                                data: "rujukan",
                                                name: "rujukan",
                                        },
                                        {
                                                "targets": 3,
                                                "class": "text-sm",
                                                data: "keluhan_pasien",
                                                name: "keluhan_pasien",
                                        },
                                        
                                ]
                    })

            })


        })


    </script>

@endpush