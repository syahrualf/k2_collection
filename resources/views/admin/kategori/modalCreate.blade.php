<div class="modal fade" id="modalCreateKategori" tabindex="-1" aria-labelledby="modalCreateKategoriLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white">
          <i class="fas fa-plus mr-2"></i>Tambah Kategori
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <form action="{{ route('kategoriStore') }}" method="POST">
        @csrf
        <div class="modal-body bg-white text-dark">
          <div class="row">
            <div class="col-12 mb-2">
              <label class="form-label"><span class="text-danger">*</span> Nama Kategori</label>
              <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid
              @enderror" value="{{old('nama_kategori')}}" required>
              @error('nama_kategori')
                <small class="text-danger">
                  {{$message}}
                </small>
              @enderror
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-times"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>

    </div>
  </div>
</div>