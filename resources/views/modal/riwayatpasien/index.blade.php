<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" style="z-index: 1050, display: none" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="menu_title">Detail Riwayat Pasien</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                                    <h5 class="font-size-15 mb-1" id="nama_pasien"><a href="#" class="text-dark"></a>
                                       
        
                                        
                            <p class="text-muted mb-0">Pasien</p>
                                </div>
                            </div>
                            <div class="mt-3 pt-1">
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-0" id="nikes"><i class="mdi mdi-format-list-numbered font-size-15 align-middle pe-2 text-primary"></i>
                                           
                                        </p>
                                        <p class="text-muted mb-0 mt-2" id="jenis_kelamin"><i class="mdi mdi-list-status font-size-15 align-middle pe-2 text-primary"></i>
                                            </p>
        
                                        <p class="text-muted mb-0 mt-2" id="no_telp"><i class="mdi mdi-list-status font-size-15 align-middle pe-2 text-primary"></i>

                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-0" id="alamat"><i class="mdi mdi-account-clock font-size-15 align-middle pe-2 text-primary"></i>
                                        </p>
        
                                        <p class="text-muted mb-0 mt-2" id="nama_orang_tua"><i class="mdi mdi-account-clock font-size-15 align-middle pe-2 text-primary"></i>
                                        </p>

                                        <p class="text-muted mb-0 mt-2" id="umur"><i class="mdi mdi-account-clock font-size-15 align-middle pe-2 text-primary"></i>
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
                                                </tr>
                                            </thead>
                    
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">            
        </div>
        </div>
    </div>
</div>
