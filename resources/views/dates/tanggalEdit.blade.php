@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Edit TAnggal Tayang</h1>
        <form action="{{ route('tanggal.update', $tanggal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Input fields -->
            <div class="mb-3">
                <label class="form-label">Tanggal Tayang</label>
                <input type="date" class="form-control @error('tanggalTayang') is-invalid @enderror" id="tanggalTayang"
                       name="tanggalTayang" value="{{ old('tanggalTayang', $tanggal->tanggalTayang) }}">

                @error('tanggalTayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary mt-3" type="submit">Edit</button>
        </form>

    </div>
</div>
@endsection
