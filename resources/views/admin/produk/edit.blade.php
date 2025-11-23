@extends('admin/layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumb as $bc)
                @if ($bc['url'])
                    <li class="breadcrumb-item">
                        <a href="{{ $bc['url'] }}" class="text-dark">{{ $bc['name'] }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $bc['name'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>

    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    <div class="card">
        <div class="card-header bg-dark text-white d-flex flex-wrap justify-content-center justify-content-xl-between">
            <a href="{{ route('produk') }}" class="btn btn-sm btn-primary mb-1 mr-1">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('produkUpdate', $produk->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">
                            <span class="text-danger">*</span> Nama Produk
                        </label>
                        <input type="text" name="nama" 
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $produk->nama) }}">
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-xl-6 mb-3">
                        <label class="form-label">
                            <span class="text-danger">*</span> Kategori
                        </label>
                        <select name="kategori_id"
                                class="form-control @error('kategori_id') is-invalid @enderror">
                            <option disabled>-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-xl-6 mb-3">
                        <label class="form-label">
                            <span class="text-danger">*</span> Harga
                        </label>
                        <input type="number" name="harga"
                               class="form-control @error('harga') is-invalid @enderror"
                               value="{{ old('harga', $produk->harga) }}">
                        @error('harga')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Detail Produk</label>
                        <textarea name="detail"
                                  class="form-control @error('detail') is-invalid @enderror"
                                  rows="4">{{ old('detail', $produk->detail) }}</textarea>
                        @error('detail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Foto Produk</label>
                        <div class="mb-2">
                            @if ($produk->foto)
                                <img id="preview-foto"
                                     src="{{ asset('storage/fotoProduk/' . $produk->foto) }}"
                                     alt="Foto Produk" 
                                     style="max-width: 150px; border-radius: 5px;">
                            @else
                                <img id="preview-foto" src="#" style="display:none; max-width:150px;">
                            @endif
                        </div>

                        <label for="foto" class="btn btn-sm btn-secondary mb-2">
                            <i class="fas fa-camera mr-1"></i> Ganti Foto
                        </label>

                        <input type="file" name="foto" id="foto"
                               class="d-none @error('foto') is-invalid @enderror">

                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-success mt-2">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#foto').change(function () {
        let input = this;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-foto').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
@endsection
