@extends('layouts.app')

@section('content')

<style>
    .film-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        width: calc(33.333% - 10px); /* Adjust the width to fit three items per row with some margin */
        margin: 5px;
        cursor: pointer; /* Add pointer cursor for clickable effect */
    }

    .film-card img {
        width: 100%;
        height: 400px; /* Fixed height for uniformity */
        object-fit: cover; /* Ensures the image covers the entire area without stretching */
        transition: transform 0.3s ease;
    }

    .film-card:hover img {
        transform: scale(1.1);
    }

    .film-description {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
        text-align: center;
    }

    .film-card:hover .film-description {
        opacity: 1;
    }

    .film-label {
        display: block;
        text-align: center;
        margin-top: 10px;
        position: relative;
    }

    .film-card .btn-order {
        position: absolute;
        bottom: 10px; /* Adjust according to your design */
        left: 50%;
        transform: translateX(-50%);
        background-color: #28a745; /* Green background color */
        color: white;
        border: none;
        padding: 5px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem; /* Font size for the icon */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .film-card .btn-order i {
        margin-right: 5px; /* Space between icon and text */
    }

    .film-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .poss {
        position: static;
    }
</style>

<div>
    <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('detail.create') }}">
        <i class="fas fa-plus"></i> Tambah Detail
    </a>
</div>

<div class="film-container">
    @foreach ($detail as $item)

    <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film1Modal">
        <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
        <div class="film-description">
            <p>Tanggal rilis: {{ $item->tanggalRilis }}</p>
            <h1 class="poss">{{ $item->judul }}</h1>
            <p>Pemeran: {{ $item->pemeran }}</p>
            <p>Penulis: {{ $item->penulis }}</p>
            <p>Sutradara: {{ $item->sutradara }}</p>
            <p>Perusahaan Produksi: {{ $item->perusahaanProduksi }}</p>
            <p>{{ $item->deskripsi }}</p>
        </div>

        <a href="{{ route('detail.edit', $item->id) }}">
            <button type="button" class="btn btn-success btn-sm">
                <ion-icon name="trash-outline"></ion-icon>
            </button>
        </a>

        <a href="{{ route('detail.delete', $item->id) }}">
            <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                <ion-icon name="trash-outline"></ion-icon>
            </button>
        </a>
    </div>

    @endforeach
</div>

@endsection
