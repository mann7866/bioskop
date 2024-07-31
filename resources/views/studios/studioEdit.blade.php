@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <h1 class="form-title text-center text-secondary">Edit kursi</h1>
            <form action="{{ route('studio.update', $studio->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label class="form-label">Studio:</label>
                    <input type="text" class="form-control @error('studio') is-invalid @enderror" id="studio"
                        name="studio" value="{{ $kursi->studio }}">
                    @error('studio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-outline-primary mt-3 col-md-2 hover" type="submit" name="submit">
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
                <a href="{{ route('studio') }}" class="btn btn-outline-danger mt-3 col-md-2 hover">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </a>
            </form>
        </div>
    </div>
@endsection
