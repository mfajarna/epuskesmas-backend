<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" style="z-index: 1050, display: none" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="menu_title">Detail Surat Rujukan</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Surat Rujukan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mt-3 pt-1">
                                <form action="{{ route('admin.suratrujukan.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="id_pemeriksaan" name="id_pemeriksaan" />
                                    <input type="hidden" id="id_pasien" name="id_pasien" />
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nama Rumah Sakit</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="nama_rumah_sakit" id="horizontal-firstname-input" placeholder="Nama rumah sakit" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Dokter Ahli Bagian</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="dokter_ahli_bagian" id="horizontal-firstname-input" placeholder="Dokter Ahli Bagian" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Di </label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="di" id="horizontal-firstname-input" placeholder="Di" required>
                                        </div>
                                    </div>
                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>Dengan hasil pemeriksaan sementara sebagai berikut: </h5>
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Keterangan medis</label>
                                        <div class="col-sm-9">
                                          <textarea class="form-control" name="keterangan_medis" id="horizontal-firstname-input" placeholder="Keterangan Medis" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Diagnosis</label>
                                        <div class="col-sm-9">
                                          <textarea class="form-control" name="diagnosis" id="horizontal-firstname-input" placeholder="Diagnosis"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Keterangan lain</label>
                                        <div class="col-sm-9">
                                          <textarea class="form-control" name="keterangan_lain" id="horizontal-firstname-input" placeholder="Keterangan lain"></textarea>
                                        </div>
                                    </div>
                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>Nomor Surat</h5>
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nomor Surat</label>
                                        <div class="col-sm-9">
                                          <input type="number" class="form-control" name="no_surat" id="horizontal-firstname-input" placeholder="Nomor surat" required>/PKM-LGJ/2022
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
        
                    </div>
                    <!-- end card -->
                </div> 
            </div>
            
        </div>
        <div class="modal-footer">            
        </div>
        </div>
    </div>
</div>
