@extends('layouts.dashboard.app')

@section('title', 'Manajemen Antrian Poli')

@push('after-style')

        <!-- DataTables -->
        <link href="{{ url('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ url('/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')

<div class="row pt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Manajemen Antrian</h4>
               
            </div>

            <div class="row px-4">

                <div class="container-fluid  pt-4">
                    <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                        <i class="mdi mdi-alert-outline label-icon"></i><strong>Notifikasi</strong> - Mohon untuk meng-aktifkan status antrian poli untuk menggunakan fitur next antrian
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
        
        
                <audio src="" hidden></audio>
        
        
                @foreach ($antrian as $antrians )
                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
        
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex align-items-center">
        
        
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h4 class="text-muted mb-3 lh-1 d-block text-truncate">{{ $antrians->poli->nama_poli }}</h4>
                                                    <h4 class="mb-3">
                                                        <span class="counter-value" data-target="{{ $antrians->no_antrian }}">{{ $antrians->no_antrian }}</span>
                                                    </h4>
                                                    <div class="text-nowrap">
                                                        <div class="row">
                                                            <div class="col-xl-3 mr-4">
                                                                <span class="ms-1 text-muted font-size-13">Status Poli </span>
                
                                                                @if ($antrians->poli->is_active == 1)
                                                                    <span class="badge bg-soft-success text-success" id="status_poli">Active</span> 
                                                                @else
                                                                <span class="badge bg-soft-danger text-danger" id="status_poli">Non-Active</span> 
                                                                @endif
                                                                
                                                                 
                                                            </div>
                                                        </div>
                
                                                        <div class="row">
                                                            <div class="col-xl-3 mr-4">
                                                                <span class="ms-1 text-muted font-size-13">Status Antrian </span>
                                                                
                                                                @if ($antrians->status === "active")
                                                                <span class="badge bg-soft-success text-success" id="status_poli">Active</span> 
                                                                @else
                                                                <span class="badge bg-soft-danger text-danger" id="status_poli">Non-Active</span> 
                                                                @endif
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                
                            
                                            
                                        </div>
                                    </div>
        
        
                                    @if ($antrians->status == "active")
                                        <div class="col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <button type="button" id="btn_next_antrian" value="{{ $antrians->id }}" onclick="onNext(this)" class="btn btn-success waves-effect btn-label waves-light"><i class="bx bx-skip-next label-icon"></i>Next Antrian</button>
                                            </div>
                                        </div>  
                                    @endif
        
        
                                </div>
        
        
        
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                @endforeach
        
        
            </div>

            <div class="card-body">
                <div class="pt-2">
                    <table id="table-data" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" style="width: 1573px;">
                        <thead>
                            <tr role="row">
                                <th class="text-center">Nama Poli</th>
                                <th class="text-center">Status Poli</th>
                                <th class="text-center">Status Antrian</th>
                                <th class="text-center">Nomor Antrian</th>
                                <th class="text-center">Aksi</th>
                        </thead>

                    </table>
                </div>
            </div>
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
                    [3, "ASC"]
                ],
                ajax:{
                    url: "{{ route('admin.antrian.index') }}"
                },
                columnDefs:[
                    {targets:'_all', visible: true},
                    {
                        "targets": 0,
                        "class": "text-sm",
                        data: "poli.nama_poli",
                        name: "poli.nama_poli"
                    },
                    {
                        "targets": 1,
                        "class": "text-sm",
                        data: "poli.is_active",
                        name: "poli.is_active",
                        render: function(data, type, full, meta)
                        {
                            if(data == 1)
                            {
                                return '<span class="badge badge-pill badge-soft-success font-size-11">Active</span>'
                            }else{
                                return '<span class="badge badge-pill badge-soft-danger font-size-11">Non-Active</span>'
                            }   
                            
                        }
                    },
                    {
                        "targets": 2,
                        "class": "text-sm",
                        data: "status",
                        name: "status",
                        render: function(data, type, full, meta)
                                {
                                    if(data == "active")
                                    {
                                        return '<span class="badge badge-pill badge-soft-success font-size-11">Active</span>'
                                    }else{
                                        return '<span class="badge badge-pill badge-soft-danger font-size-11">Non-Active</span>'
                                    }   
                                   
                                }
                    },
                    {
                        "targets": 3,
                        "class": "text-sm",
                        data: "no_antrian",
                        name: "no_antrian"
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

            t.on('click', '#btn_active', function() {
                $tr = $(this).closest('tr');
                        if($($tr).hasClass('child')){
                            $tr = $tr.prev('.parent')
                        }

                    var data = t.row($tr).data();
                    var id = data.id;

                    var status = "active";

                    $.ajax({
                        method: 'get',
                        url: '{{ route("admin.antrian.editstatus") }}',
                        data: {id:id, status:status},
                        success: function(res)
                            {
                                $('#table-data').DataTable().ajax.reload();
                            }
                    })

                    location.reload();


                    
            })

            t.on('click', '#btn_non_active', function() {
                $tr = $(this).closest('tr');
                        if($($tr).hasClass('child')){
                            $tr = $tr.prev('.parent')
                        }

                    var data = t.row($tr).data();
                    var id = data.id;

                    var status = "non-active";

                    $.ajax({
                        method: 'get',
                        url: '{{ route("admin.antrian.editstatus") }}',
                        data: {id:id, status:status},
                        success: function(res)
                            {
                                $('#table-data').DataTable().ajax.reload();

                               
                            }
                    })

                    location.reload();
                    
            })

            t.on('click', '#btn_reset', function()
            {
                $tr = $(this).closest('tr');
                        if($($tr).hasClass('child')){
                            $tr = $tr.prev('.parent')
                        }

                    var data = t.row($tr).data();
                    var id = data.id;

                    $.ajax({
                        method: 'get',
                        url: '{{ route("admin.antrian.reset") }}',
                        data: {id:id},
                        success: function (res)
                        {
                            $('#table-data').DataTable().ajax.reload();
                        }
                    })

                    location.reload();
            })
        })


        function onNext(objButton)
        {
            var id = objButton.value;

            $.ajax({
                method: 'get',
                url: '{{ route("admin.antrian.next") }}',
                data: {id:id},
                success: function(res)
                {
                    
                    var nama_poli = res[0];
                    var nextAntrian = res[1];
                }    
            })


            location.reload();

        }


 
    </script>
@endpush