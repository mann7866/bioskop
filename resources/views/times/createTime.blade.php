@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Waktu Tayang</h1>
        <form action="{{ route('time.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="jamTayang" class="form-label">Jam Tayang</label>
                <input type="time" class="form-control @error('jamTayang') is-invalid @enderror" id="jamTayang"
                       name="jamTayang" step="60">
                @error('jamTayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Tayang</label>

                <input type="date" class="form-control @error('tanggalTayang') is-invalid @enderror" id="tanggalTayang"
                name="tanggalTayang">

                @error('tanggalTayang')
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
