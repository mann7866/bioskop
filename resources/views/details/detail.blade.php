@extends('layouts.app')

@section('content')
    <style>
       .film-card {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
    width: calc(50% - 10px);
    margin: 5px;
    cursor: pointer;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    height: 300px; /* Tinggi tetap untuk card */
    display: flex;
    flex-direction: column;
}

.film-card img {
    width: 100%;
    height: 100%; /* Mengisi tinggi kartu */
    object-fit: cover; /* Memotong gambar jika perlu */
    transition: transform 0.3s ease;
}

.film-card:hover img {
    transform: scale(1.1);
}

/* Gaya lainnya tetap sama */


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

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: none;
            background-color: #f8f9fa;
            border-radius: 10px 10px 0 0;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .modal-body {
            padding: 20px;
            text-align: center;
        }

        .modal-body img {
            border-radius: 10px;
            margin-bottom: 15px;
            max-width: 100%; /* Menyesuaikan gambar agar tidak melewati lebar modal */
        }

        .modal-footer {
            border-top: none;
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        .modal-footer .btn-secondary {
            border-radius: 20px;
            background-color: #6c757d;
            color: #fff;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
        }

        .film-description ul {
            list-style: none;
            padding: 0;
        }

        .film-description ul li {
            display: inline-block;
            margin: 0 5px;
            padding: 3px 6px;
            background: #007bff;
            color: #fff;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .modal-body ul {
            list-style: none;
            padding: 0;
        }

        .modal-body ul li {
            display: inline-block;
            margin: 0 5px;
            padding: 3px 6px;
            background: #007bff;
            color: #fff;
            border-radius: 12px;
            font-size: 0.9rem;
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
        .warning {
        background-color: blue;
        transition: 2s ease;
        position: relative;
        overflow: hidden;
    }

    /* .warning:hover {
        border-radius: 25px 27px;
    } */

    .warning::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: red;
        transition: all 0.3s;
    }

    .warning:hover::after {
        left: 0;
        width: 100%;
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
                    <h1 class="poss">{{ $item->judul }}</h1>
                    <p>Tanggal rilis: {{ $item->tanggalRilis }}</p>
                    <h2>Genres:</h2>
                            <ul>
                                @foreach ($item->genres as $genre)
                                    <li>{{ $genre->genre }}</li>
                                @endforeach
                            </ul>
                    <p>{{ $item->deskripsi }}</p>

                </div>


            </div>

            <!-- Modal -->
            <div class="modal fade" id="film{{ $item->id }}Modal" tabindex="-1"
                aria-labelledby="film{{ $item->id }}ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="film{{ $item->id }}ModalLabel">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                            <h2>Genres:</h2>
                            <ul>
                                @foreach ($item->genres as $genre)
                                    <li>{{ $genre->genre }}</li>
                                @endforeach
                            </ul>
                            <p><strong>Tanggal Rilis:</strong> {{ $item->tanggalRilis }}</p>
                            <p><strong>Pemeran:</strong> {{ $item->pemeran }}</p>
                            <p><strong>Penulis:</strong> {{ $item->penulis }}</p>
                            <p><strong>Sutradara:</strong> {{ $item->sutradara }}</p>
                            <p><strong>Perusahaan Produksi:</strong> {{ $item->perusahaanProduksi }}</p>
                            <p><strong>Deskripsi:</strong>{{ $item->deskripsi }}</p>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
