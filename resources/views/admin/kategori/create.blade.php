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
    <h1 class="h3 mb-4 text-gray-800">{{$title}}</h1>
    <div class="card">
        <div class="card-header bg-dark text-white d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-1">
                <a href="{{ route('kategori')}}" class="btn btn-sm btn-info">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('kategoriStore') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid
                        @enderror" value="{{old('nama_kategori')}}">
                        @error('nama_kategori')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-sm btn-primary mt-2">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>

        </div>

    </div>
@endsection