@extends('layouts.app')

@section('content')
    <style>
        * {
            scroll-behavior: smooth;
        }

        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
            width: calc(33.333% - 10px);
            margin: 5px;
            cursor: pointer;
        }

        .film-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .film-card:hover img {
            transform: scale(1.1);
        }

        .film-description {
            position: absolute;
            bottom: 40px;
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

        .film-card .btn-pesan {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .film-card .btn-pesan i {
            margin-right: 5px;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center mb-4">
                    <div class="card-header">{{ __('Bioskop') }}</div>
                    <div class="card-body">
                        <p>{{ __('Welcome to Bioskop') }}</p>
                    </div>
                </div>
                <div id="filmCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="film-container">
                                {{-- Film 1 --}}
                                @foreach ($detail as $item)

                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film1Modal">
                                    <img src="{{ asset('image/'. $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5 class="poss">{{ $item->judul }}</h5>
                                        <p>{{ $item->deskripsi }}</p>
                                    </div>
                                    <label class="film-label">
                                        {{ $item->judul }}
                                    </label>
                                </div>

                                @endforeach
                                {{-- Film 2 --}}

                                {{-- Film 3 (Oshi No Ko) --}}

                            </div>
                        </div>

                    </div>
                    {{-- Tombol kontrol carousel dihapus karena komentar --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Modals untuk masing-masing film --}}
    @foreach ($detail as $item)
        <div class="modal fade" id="film1Modal" tabindex="-1" aria-labelledby="film1ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="film1ModalLabel">{{ $item->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="embed-responsive embed-responsive-16by9">

                            <p>Tanggal Rilis: {{ $item->tanggalRilis }}</p>
                            <p>Perusahaan Produksi: {{ $item->perusahaanProduksi }}</p>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                        <h1>Test</h1>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
@endsection
