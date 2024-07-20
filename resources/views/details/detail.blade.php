@extends('layouts.app')

@section('content')
    <style>
        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
            width: calc(50% - 10px);
            /* Adjust the width to fit two items per row with some margin */
            margin: 5px;
            cursor: pointer;
            /* Add pointer cursor for clickable effect */
        }

        .film-card img {
            width: 100%;
            height: 150%;
            /* Reduced height for smaller images */
            object-fit: cover;
            /* Ensures the image covers the entire area without stretching */
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

        .btn-edit,
        .btn-delete {
            position: absolute;
            top: 10px;
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .btn-edit {
            left: 10px;
        }

        .btn-delete {
            right: 10px;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }

        .btn-edit ion-icon,
        .btn-delete ion-icon {
            font-size: 20px;
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .poss {
            position: static;
        }

        /* Media queries to ensure responsiveness */
        @media (max-width: 768px) {
            .film-card {
                width: calc(50% - 10px);
            }
        }

        @media (max-width: 576px) {
            .film-card {
                width: 100%;
            }
        }
    </style>

    <div>
        <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('detail.create') }}">
            <i class="fas fa-plus"></i> Tambah Detail
        </a>
    </div>

    <div class="film-container">
        @foreach ($detail as $item)
            <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film{{ $item->id }}Modal">
                <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                <div class="film-description">
                    <p>Tanggal rilis: {{ $item->tanggalRilis }}</p>

                    <style>
                        .genre-item {
                            display: inline-block;
                            margin-right: 3px;
                        }
                    </style>

                    <h1 class="poss">{{ $item->judul }}</h1>
                    <p>{{ $item->deskripsi }}</p>
                    <p>Tanggal rilis: {{ $item->tanggalRilis }}</p>
                </div>

                <a href="{{ route('detail.edit', $item->id) }}">
                    <button type="button" class="btn-edit">
                        <ion-icon name="create-outline"></ion-icon>
                    </button>
                </a>

                <a href="{{ route('detail.delete', $item->id) }}">
                    <button type="button" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="film{{ $item->id }}Modal" tabindex="-1"
                aria-labelledby="film{{ $item->id }}ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="film{{ $item->id }}ModalLabel">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid mb-3"
                                alt="{{ $item->judul }}">

                            <h2>Genres:</h2>
                                <ul>
                                    @foreach ($item->genres as $genre)
                                        {{ $genre->genre }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </ul>


                                <p>Tanggal Rilis: {{ $item->tanggalRilis }}</p>
                                <p>Pemeran: {{ $item->pemeran }}</p>
                                <p>Penulis: {{ $item->penulis }}</p>
                                <p>Sutradara: {{ $item->sutradara }}</p>
                                <p>Perusahaan Produksi: {{ $item->perusahaanProduksi }}</p>
                                <p>{{ $item->deskripsi }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
