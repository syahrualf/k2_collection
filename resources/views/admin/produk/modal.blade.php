<div class="modal fade" id="modalProdukDestroy{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Hapus {{ $title }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row mb-1">
                    <div class="col-6 font-weight-bold">Nama Produk</div>
                    <div class="col-6">: {{ $item->nama}}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-6 font-weight-bold">Kategori</div>
                    <div class="col-6">: {{ $item->kategori->nama_kategori }}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-6 font-weight-bold">Harga</div>
                    <div class="col-6">: Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-6 font-weight-bold">Stok</div>
                    <div class="col-6">: {{ $item->stok }}</div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>

                <form action="{{ route('produkDestroy', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalProdukShow{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalProdukShowTitle{{ $item->id }}" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalProdukShowTitle{{ $item->id }}">
                    <i class="fas fa-box mr-2"></i> Detail {{ $title }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="text-center mb-3">
                    <img src="{{ asset('storage/fotoProduk/' . $item->foto) }}" alt="Foto Produk" class="img-thumbnail"
                        style="max-width: 150px; border-radius: 5px;">
                </div>

                <div class="row mb-1">
                    <div class="col-5 font-weight-bold">Nama Produk</div>
                    <div class="col-7">: {{ $item->nama }}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-5 font-weight-bold">Kategori</div>
                    <div class="col-7">: {{ $item->kategori->nama_kategori }}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-5 font-weight-bold">Harga</div>
                    <div class="col-7">: Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-5 font-weight-bold">Stok</div>
                    <div class="col-7">: {{ $item->stok }}</div>
                </div>

                <div class="row mb-1">
                    <div class="col-5 font-weight-bold">Detail</div>
                    <div class="col-7">: {{ $item->detail ?? '-' }}</div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Tutup
                </button>
            </div>

        </div>
    </div>

</div>