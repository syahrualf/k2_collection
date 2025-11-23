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
                <a href="{{ route('user')}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('userUpdate', $user->id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid
                        @enderror" value="{{$user->nama}}">
                        @error('nama')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Username</label>
                        <input type="username" name="username" class="form-control @error('username') is-invalid
                        @enderror" value="{{$user->username}}">
                        @error('username')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                        @enderror
                    </div>

                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid
                        @enderror">
                        @error('password')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Password Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid
                        @enderror">

                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-sm btn-primary mt-2">
                        <i class="fas fa-upload mr-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection