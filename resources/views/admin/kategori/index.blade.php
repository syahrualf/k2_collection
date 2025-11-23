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
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateKategori">
                    <i class="fas fa-plus mr-2"></i>Tambah Data
                </button>
                @include('admin/kategori/modalCreate')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama_kategori}}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary mb-1" data-toggle="modal"
                                        data-target="#modalEditKategori{{ $item->id}}"><i class="fas fa-edit"></i></button>

                                    <button class="btn btn-sm btn-dark" data-toggle="modal"
                                        data-target="#modalDestroyKategori{{ $item->id}}"><i class="fas fa-trash"></i></button>

                                    @include('admin/kategori/modal')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection