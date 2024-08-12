@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Waktu Tayang</h1>
        <form action="{{ route('time.store') }}" method="POST">
            @csrf


                <!-- Input Waktu Mulai -->
                <div class="mb-3">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                           id="jam_mulai" name="jam_mulai"
                           value="{{ old('jam_mulai', '') }}">
                    @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Waktu Selesai -->
                <div class="mb-3">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                           id="jam_selesai" name="jam_selesai"
                           value="{{ old('jam_selesai', '') }}">
                    @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <button class="btn btn-primary mt-3" type="submit">
                    Tambah
                </button>
            </form>

    </div>
</div>
@endsection
