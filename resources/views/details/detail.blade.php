@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
    <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
@endif

@if (session('delete'))
<div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
    <div class="toast align-items-center bg-danger text-white border-0 show slide-down" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('delete') }}
            </div>
        </div>
    </div>
</div>
@endif

    <style>
        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            flex: 0 0 calc(50% - 20px); /* Adjusted to fit two items side by side */
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .film-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
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
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 100%);
            color: #fff;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
            text-align: center;
            border-radius: 0 0 10px 10px;
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

        .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header,
        .modal-footer {
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            width: 100%;
            position: absolute;
            left: 0;
        }

        .modal-header .btn-close {
            position: absolute;
            right: 15px;
        }

        .modal-body {
            padding: 20px;
            text-align: center;
        }

        .modal-body img {
            border-radius: 10px;
            margin-bottom: 15px;
            max-width: 100%;
        }

        .modal-footer .btn-secondary {
            border-radius: 20px;
            background-color: #6c757d;
            color: #fff;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
        }

        .film-description ul,
        .modal-body ul {
            list-style: none;
            padding: 0;
        }

        .film-description ul li,
        .modal-body ul li {
            display: inline-block;
            margin: 0 5px;
            padding: 3px 6px;
            background: #007bff;
            color: #fff;
            border-radius: 12px;
            font-size: 0.9rem;
        }

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
        <a class="btn btn-primary mt-5 m-2" href="{{ route('detail.create') }}">
            <i class="fas fa-plus"></i> Tambah Detail
        </a>
    </div>

    <div class="film-container">
        @foreach ($detail as $item)
            <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film{{ $item->id }}Modal">
                <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                <div class="film-description">
                    @if ($item->time)
                    @endif
                    <h1>{{ $item->judul }}</h1>
                    <p>Genres:</p>
                    <ul>
                        @foreach ($item->genres as $genre)
                        <li>{{ $genre->genre }}</li>
                        @endforeach
                    </ul>
                    <p>{{ $item->deskripsi }}</p>   
                    <p>Tanggal Rilis: {{ $item->tanggalRilis }}</p>
                    <p>Tayang: {{ $item->time->tanggalTayang }} | {{ $item->time->jamTayang }}</p>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="film{{ $item->id }}Modal" tabindex="-1" aria-labelledby="film{{ $item->id }}ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="film{{ $item->id }}ModalLabel">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                            <p><strong>Harga Tiket:</strong> Rp. {{ number_format($item->harga) }}</p>
                            <h2>Genres:</h2>
                            <ul>
                                @foreach ($item->genres as $genre)
                                    <li>{{ $genre->genre }}</li>
                                @endforeach
                            </ul>
                            <p><strong>Pemeran:</strong> {{ $item->pemeran }}</p>
                            <p><strong>Penulis:</strong> {{ $item->penulis }}</p>
                            <p><strong>Sutradara:</strong> {{ $item->sutradara }}</p>
                            <p><strong>Perusahaan Produksi:</strong> {{ $item->perusahaanProduksi }}</p>
                            <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                            <p><strong>Tanggal Rilis:</strong> {{ $item->tanggalRilis }}</p>
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
                </div>
            </div>
        @endforeach
    </div>
@endsection
