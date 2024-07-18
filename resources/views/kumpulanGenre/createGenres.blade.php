@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Genre</h1>
        <form action="{{ route('genres.store') }}" method="POST" >
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Film</label>
                <select class="mt-3 form-select @error('id_judul') is-invalid @enderror" aria-label="Select Category"
                    name="id_judul">
                    <option selected disabled>Pilih Judul Film</option>
                    @foreach ($detail as $item)
                        <option value="{{ $item->id }}">{{ $item->judul }}</option>
                    @endforeach
                </select>
                @error('id_judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Genre Film</label>
                <select class="mt-3 form-select @error('id_genre') is-invalid @enderror" aria-label="Select Category"
                    name="id_genre">
                    <option selected disabled>Pilih Genre Film</option>
                    @foreach ($genre as $item)
                        <option value="{{ $item->id }}">{{ $item->genre }}</option>
                    @endforeach
                </select>
                @error('id_genre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-outline-primary mt-3 col-md-2 hover" type="submit" name="submit">
                <ion-icon name="add-circle-outline"></ion-icon>
            </button>
            <a href="{{route('genre')}}" class="btn btn-outline-danger mt-3 col-md-2 hover" ><ion-icon name="arrow-back-outline"></ion-icon></a>
        </form>
    </div>
</div>
<style>
    .hover:hover{
        cursor: pointer;
        text-decoration: underline;
        border-radius: 20px 27px;
    }
</style>
@endsection
