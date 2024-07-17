@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Genre</h1>
        <form action="{{ route('genre.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre"
                    name="genre" placeholder="Enter Metode Pembayaran">
                @error('genre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">
                Tambah
            </button>
        </form>
    </div>
</div>
@endsection
