@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <h1 class="form-title text-center">Tambah Tanggal Tayang</h1>
            <form action="{{ route('tanggal.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>

                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai"
                        name="tanggal_mulai" value="{{ old('tanggal_mulai', '') }}">


                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>

                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai"
                        name="tanggal_selesai" value="{{ old('tanggal_selesai', '') }}">


                    @error('tanggal_selesai')
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
