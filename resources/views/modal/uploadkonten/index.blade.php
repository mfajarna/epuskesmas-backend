<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" style="z-index: 1050, display: none" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="menu_title">Tambah Data Konten Informasi Kesehatan</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form method="POST" action="{{ route('admin.uploadinformasikesehatan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <label for="nama_poli" class="col-form-label">Judul Konten:</label>
                    <input type="text" class="form-control" id="judul_konten" name="judul_konten" placeholder="Masukan judul konten" value="{{ old('judul_konten') }}" required>
                    
                    <label for="deskripsi_konten" class="col-form-label">Deskripsi Konten:</label>
                    <textarea class="form-control" id="deskripsi_konten" name="deskripsi_konten"></textarea>

                    <label for="nama_poli" class="col-form-label">Gambar Konten:</label>
                    <input class="form-control" type="file" id="path_gambar" name="path_gambar" required>
                    <span class="text-muted">File: png, max size: 2mb</span>
                
        </div>
        <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Simpan</button>

            </form>
            <button type="button" class="btn btn-link text-gray text-gradient px-4 mb-0 mt-2 close-modal" onClick="closeModal()" data-dismiss="modal">Close</button>
            
        </div>
        </div>
    </div>
</div>
