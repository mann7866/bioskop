@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Edit Waktu Tayang</h1>
        <form action="{{ route('time.update', $time->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label class="form-label">Judul Film</label>
                <select class="mt-3 form-select @error('id_judul') is-invalid @enderror"
                        aria-label="Select Payment Method" name="id_judul">
                    <option selected disabled>Pilih Judul</option>
                    @foreach ($detail as $item)
                    <option value="{{ $item->id }} "@if ($item->id == $time->id_judul) selected @endif>{{ $item->judul }}</option>
                @endforeach
                </select>
                @error('id_judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
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
