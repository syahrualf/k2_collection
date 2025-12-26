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
                <a href="{{ route('faqCreate') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faq as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->question}}</td>
                                <td>{{ $item->answer}}</td>
                                <td>
                                    <a href="{{ route('faqEdit', $item->id) }}" class="btn btn-sm btn-primary mb-1"><i
                                            class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-dark" data-toggle="modal"
                                        data-target="#modalDestroyFaq{{ $item->id }}"><i class="fas fa-trash"></i></button>
                                         @include('admin/faq/modal')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection