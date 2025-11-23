<!-- Modal Edit Kategori -->
<div class="modal fade" id="modalEditKategori{{ $item->id }}" tabindex="-1"
  aria-labelledby="modalEditKategoriLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white">
          <i class="fas fa-edit mr-2"></i>Edit Kategori
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <form action="{{ route('kategoriUpdate', $item->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="modal-body bg-white text-dark">
          <div class="row">
            <div class="col-12 mb-2">
              <label class="form-label"><span class="text-danger">*</span> Nama Kategori</label>
              <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror"
                value="{{ $item->nama_kategori }}" required>
              @error('nama_kategori')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-times"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Hapus Kategori -->
<div class="modal fade" id="modalDestroyKategori{{ $item->id }}" tabindex="-1" role="dialog"
  aria-labelledby="modalDestroyKategoriLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">
          <i class="fas fa-exclamation-triangle mr-2"></i>Hapus Kategori
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row mb-1">
          <div class="col-5 font-weight-bold">Nama Kategori: </div>
          <div class="col-7">: {{ $item->nama_kategori}}</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <i class="fas fa-times mr-1"></i> Batal
        </button>

        <form action="{{ route('kategoriDestroy', $item->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash-alt"></i> Hapus
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
