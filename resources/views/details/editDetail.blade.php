@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Edit Detail Film</h1>
        <form action="{{ route('detail.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                       name="judul" value="{{ $detail->judul }}">
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Rilis</label>

                <input type="date" class="form-control @error('tanggalTayang') is-invalid @enderror" id="tanggalRilis"
                name="tanggalRilis" value="{{ $detail->tanggalRilis }}">

                @error('tanggalRilis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Pemeran</label>

                <input type="text" class="form-control @error('pemeran') is-invalid @enderror" id="pemeran"
                name="pemeran" value="{{ $detail->pemeran }}">

                @error('pemeran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Penulis</label>

                <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                name="penulis" value="{{ $detail->penulis }}">

                @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Sutradara</label>

                <input type="text" class="form-control @error('sutradara') is-invalid @enderror" id="sutradara"
                name="sutradara" value="{{ $detail->sutradara }}">

                @error('sutradara')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Perusahaan Produksi</label>

                <input type="text" class="form-control @error('perusahaanProduksi') is-invalid @enderror" id="perusahaanProduksi"
                name="perusahaanProduksi" value="{{ $detail->perusahaanProduksi }}">

                @error('perusahaanProduksi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>

                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5">{{ $detail->deskripsi }}</textarea>

                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row col-4 mt-5">
                <div class="card">
            <img src="{{ asset('image/' .$detail->foto) }}" class="card-img-top" alt="{{ $detail->judul }}">
            </div>

            <div class="mb-3">
                <div class="card-title">Upload Foto</div>
                <div class="input-group mb-3">
                    <input type="file" name="foto" class="form-control" id="inputGroupFile">
                    <label for="" class=" btn btn-success input-group-text">Upload</label>
                </div>

                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">
                Edit Deskripsi
            </button>
        </form>
    </div>
</div>
@endsection
