@extends('layouts.app')

@section('content')
{{-- syle --}}
<div class="container mt-4">
    <h1 class="text-center mb-4 text-secondary  ">Tambah  Film</h1>
    <form class="row g-3 needs-validation" action="{{ route('detail.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="col-md-6">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mt-5 sty">
            <label class="form-label">Genre:</label>
            @foreach ($genre as $item)
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('genres') is-invalid @enderror" type="checkbox" name="genres[]" value="{{ $item->id }}" id="genre-{{ $item->id }}">
                    <label class="form-check-label" for="genre-{{ $item->id }}">
                        {{ $item->genre }}
                    </label>
                </div>
            @endforeach
            @error('genres')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="tanggalRilis" class="form-label">Tanggal Rilis</label>
            <input type="date" class="form-control @error('tanggalRilis') is-invalid @enderror" id="tanggalRilis" name="tanggalRilis" value="{{ old('tanggalRilis') }}">
            @error('tanggalRilis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="pemeran" class="form-label">Pemeran</label>
            <input type="text" class="form-control @error('pemeran') is-invalid @enderror" id="pemeran" name="pemeran" value="{{ old('pemeran') }}">
            @error('pemeran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}">
            @error('penulis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="sutradara" class="form-label">Sutradara</label>
            <input type="text" class="form-control @error('sutradara') is-invalid @enderror" id="sutradara" name="sutradara" value="{{ old('sutradara') }}">
            @error('sutradara')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="perusahaanProduksi" class="form-label">Perusahaan Produksi</label>
            <input type="text" class="form-control @error('perusahaanProduksi') is-invalid @enderror" id="perusahaanProduksi" name="perusahaanProduksi" value="{{ old('perusahaanProduksi') }}">
            @error('perusahaanProduksi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="harga" class="form-label">Harga Tiket</label>
            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Jam Tayang</label>
            <select class="mt-3 form-select @error('id_time') is-invalid @enderror"
                    aria-label="Select Payment Method" name="id_time">
                <option selected disabled>Pilih Jam Tayang</option>
                @foreach ($time as $item)
                    <option value="{{ $item->id }}">{{ $item->jamTayang }}</option>
                @endforeach
            </select>
            @error('id_time')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Tanggal Tayang</label>
            <select class="mt-3 form-select @error('id_tanggal') is-invalid @enderror"
                    aria-label="Select Payment Method" name="id_tanggal">
                <option selected disabled>Pilih Tanggal Tayang</option>
                @foreach ($tanggal as $item)
                    <option value="{{ $item->id }}">{{ $item->tanggalTayang }}</option>
                @endforeach
            </select>
            @error('id_tanggal')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Studio</label>
            <select class="mt-3 form-select @error('id_studio') is-invalid @enderror"
                    aria-label="Select Payment Method" name="id_studio">
                <option selected disabled>Pilih Studio</option>
                @foreach ($studio as $item)
                    <option value="{{ $item->id }}">{{ $item->studio }}</option>
                @endforeach
            </select>
            @error('id_studio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <div class="col-12">
            <label for="foto" class="form-label">Upload Poster</label>
            <div class="input-group">
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="inputGroupFile" name="foto" required>
                <label class="input-group-text" for="inputGroupFile">Upload</label>
            </div>
            <img id="imagePreview" class="mt-2" style="max-width: 200px; max-height: 200px; display: none;">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Tambah Film</button>
        </div>
    </form>
</div>

<script>
    // Function to preview image
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.style.display = 'block'; // Ensure image preview is visible
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Event listener for file input change
    document.getElementById('inputGroupFile').addEventListener('change', previewImage);

    // JavaScript for Bootstrap form validation
    (function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
@endsection
