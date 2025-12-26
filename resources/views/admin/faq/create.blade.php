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
            <div class="mb-1 mr-1">
                <a href="{{ route('faq') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('faqStore') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-xl-12 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Pertanyaan
                        </label>
                        <input type="text" name="question" class="form-control @error('question') is-invalid @enderror"
                            value="{{ old('question') }}">
                        @error('question')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-xl-12 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jawaban
                        </label>
                        <textarea name="answer" rows="5"
                            class="form-control @error('answer') is-invalid @enderror">{{ old('answer') }}</textarea>
                        @error('answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-sm btn-success mt-2">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection