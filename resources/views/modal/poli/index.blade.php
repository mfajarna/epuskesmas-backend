<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" style="z-index: 1050, display: none" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="menu_title">Tambah Data Poli</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form method="POST" action="{{ route('admin.poli.store') }}">
                    @csrf

                    <label for="nama_poli" class="col-form-label">Nama Poli:</label>
                    <input type="text" class="form-control" id="nama_poli" name="nama_poli" placeholder="Contoh: Poli Anak, Poli Ibu, Poli Umum" value="{{ old('nama_poli') }}" required>
                    
                    <label for="desc_poli" class="col-form-label">Deskripsi Poli:</label>
                    <textarea class="form-control" id="desc_poli" name="desc_poli"></textarea>
                
        </div>
        <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Simpan</button>

            </form>
            <button type="button" class="btn btn-link text-gray text-gradient px-4 mb-0 mt-2 close-modal" onClick="closeModal()" data-dismiss="modal">Close</button>
            
        </div>
        </div>
    </div>
</div>
