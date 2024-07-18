@extends('layouts.app')

@section('content')
    <style>

        *{
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
                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film1Modal">
                                    <img src="{{ asset('image/us-1.jpg') }}" class="img-fluid" alt="Film 1">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5 class="poss">Sou Sou No Frieren</h5>
                                        <p>Sang Elf yang telah Mengalahkan Raja Iblis</p>
                                    </div>
                                    <label class="film-label">
                                        Sou Sou No Frieren
                                    </label>
                                </div>
                                {{-- Film 2 --}}
                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film2Modal">
                                    <img src="{{ asset('image/us-3.jpg') }}" class="img-fluid" alt="Film 2">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5>Demon Slayer</h5>
                                        <p>Bercerita tentang seorang kaka yang Mencari Obat untuk Adik Ya</p>
                                    </div>
                                    <label class="film-label">
                                        Film 2
                                    </label>
                                </div>
                                {{-- Film 3 (Oshi No Ko) --}}
                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film3Modal">
                                    <img src="{{ asset('image/us-2.jpg') }}" class="img-fluid" alt="Film 3">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5>Oshi No Ko</h5>
                                        <p>Mengorbanan Sang Ibu Yang Di bunuh Fans</p>
                                    </div>
                                    <label class="film-label">
                                        Oshi No Ko
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="film-container">
                                {{-- Film 4 --}}
                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film4Modal">
                                    <img src="{{ asset('image/us-3.jpg') }}" class="img-fluid" alt="Film 4">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5>Demon Slayer Art</h5>
                                        <p>Peperangan Antara Iblis tingkat atas</p>
                                    </div>
                                    <label class="film-label">
                                        Film 4
                                    </label>
                                </div>
                                {{-- Film 5 --}}
                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film5Modal">
                                    <img src="{{ asset('image/us-4.jpeg') }}" class="img-fluid" alt="Film 5">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5>Film 5</h5>
                                        <p>Deskripsi singkat film 5.</p>
                                    </div>
                                    <label class="film-label">
                                        Film 5
                                    </label>
                                </div>
                                {{-- Film 6 --}}
                                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film6Modal">
                                    <img src="{{ asset('image/us-5.jpeg') }}" class="img-fluid" alt="Film 6">
                                    <button class="btn-pesan">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                    <div class="film-description">
                                        <h5>Film 6</h5>
                                        <p>Deskripsi singkat film 6.</p>
                                    </div>
                                    <label class="film-label">
                                        Film 6
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Tombol kontrol carousel dihapus karena komentar --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Modals untuk masing-masing film --}}
    <div class="modal fade" id="film1Modal" tabindex="-1" aria-labelledby="film1ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="film1ModalLabel">Sou Sou No Frieren</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        {{-- Konten video atau trailer di sini --}}
                        <h1>Test</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="film2Modal" tabindex="-1" aria-labelledby="film2ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="film2ModalLabel">Demon Slayer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        {{-- Konten video atau trailer di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="film3Modal" tabindex="-1" aria-labelledby="film3ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="film3ModalLabel">Oshi No Ko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="film4Modal" tabindex="-1" aria-labelledby="film4ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="film4ModalLabel">Demon Slayer Art</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        {{-- Konten video atau trailer di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="film5Modal" tabindex="-1" aria-labelledby="film5ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="film5ModalLabel">Film 5</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        {{-- Konten video atau trailer di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="film6Modal" tabindex="-1" aria-labelledby="film6ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="film6ModalLabel">Film 6</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        {{-- Konten video atau trailer di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
