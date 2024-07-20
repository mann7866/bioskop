@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <h1 class="form-title text-center">Edit lokasi</h1>
            <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-label">studio</label>
                    <input type="text" class="form-control @error('studio') is-invalid @enderror" id="studio"
                        name="studio" value="{{ $lokasi->studio }}">
                    @error('studio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">kursi</label>
                    <input type="text" class="form-control @error('kursi') is-invalid @enderror" id="kursi"
                        name="kursi" value="{{ $lokasi->kursi }}">
                    @error('kursi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-outline-primary mt-3 col-md-2  hover" type="submit" name="submit">
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
                <a href="{{ route('lokasi') }}" class="btn btn-outline-danger mt-3 col-md-2 hover"><ion-icon
                        name="arrow-back-outline"></ion-icon></a>
            </form>
        </div>
    </div>
    <style>
        .hover:hover {
            border-radius: 20px 30px;
        }
    </style>
@endsection