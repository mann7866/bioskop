@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Edit Waktu Tayang</h1>
        <form action="{{ route('time.update', $time->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="form-label">Jam Tayang</label>

                <input type="time" class="form-control @error('jamTayang') is-invalid @enderror" id="jamTayang"
                    name="jamTayang" step="60" value="{{ $time->jamTayang }}">

                @error('jamTayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Tayang</label>

                <input type="date" class="form-control @error('tanggalTayang') is-invalid @enderror" id="tanggalTayang"
                name="tanggalTayang" value="{{ $time->tanggalTayang }}">

                @error('tanggalTayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">
                Edit
            </button>
        </form>
    </div>
</div>
@endsection
