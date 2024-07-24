@extends('layouts.app')

@section('content')
    <style>
        * {
            scroll-behavior: smooth;
        }

        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            flex: 0 0 calc(16.66% - 20px);
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .film-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .film-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 10px 10px 0 0;
        }

        .film-card:hover img {
            transform: scale(1.05);
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

        .film-label-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }

        .film-label {
            margin: 0;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .btn-pesan {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            opacity: 0.9;
            margin-top: 10px;
        }

        .btn-pesan:hover {
            background-color: #ff4757;
            transform: scale(1.05);
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            padding: 10px;
        }

        .film-container::-webkit-scrollbar {
            display: none;
        }

        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }

        .back {
            color: #ffffff;
            background-color: #000;
            object-fit: cover;
            background-clip: border-box;
            background: url({{ asset('Logo/1721275807_netflix.jpg') }});
            border-radius: 10px;
        }

        .carousel-inner img {
            border-radius: 20px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .carousel-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        @media (max-width: 1200px) {
            .film-card {
                flex: 0 0 calc(20% - 20px);
            }
        }

        @media (max-width: 992px) {
            .film-card {
                flex: 0 0 calc(25% - 20px);
            }
        }

        @media (max-width: 768px) {
            .film-card {
                flex: 0 0 calc(33.33% - 20px);
            }
        }

        @media (max-width: 576px) {
            .film-card {
                flex: 0 0 calc(50% - 20px);
            }

            .carousel-inner img {
                height: 150px;
            }
        }

        @media (max-width: 400px) {
            .film-card {
                flex: 0 0 calc(100% - 20px);
            }

            .carousel-inner img {
                height: 120px;
            }
        }

        .news-container {
            margin-top: 20px;
        }

        .news-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            flex: 0 0 calc(33.33% - 20px);
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 10px 10px 0 0;
        }

        .news-card:hover img {
            transform: scale(1.05);
        }

        .news-body {
            padding: 15px;
        }

        .news-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .news-text {
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
        }

        .news-time {
            font-size: 0.85rem;
            color: #888;
        }

        @media (max-width: 768px) {
            .news-card {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .news-card {
                flex: 0 0 calc(100% - 20px);
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center mb-4 back">
                    <div class="card-header">{{ __('Bioskop') }}</div>
                    <div class="card-body">
                        <p>{{ __('Selamat Datang di Bioskop') }}</p>
                    </div>
                </div>

                <div class="container mt-4" id="film">
                    <div id="smallCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($detail as $key => $item)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('image/' . $item->foto) }}" class="d-block w-100"
                                        alt="{{ $item->judul }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#smallCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Sebelumnya</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#smallCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Berikutnya</span>
                        </button>
                    </div>
                </div>

                <div id="filmCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="film-container">
                                @forelse ($detail as $item)
                                    <div class="film-card" data-bs-toggle="modal"
                                        data-bs-target="#filmModal{{ $item->id }}">
                                        <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid"
                                            alt="{{ $item->judul }}">
                                        <div class="film-description">
                                            <h5 class="poss">{{ $item->judul }}</h5>
                                            <p>{{ $item->deskripsi }}</p>
                                        </div>
                                        
                                        <div class="film-label-container">
                                            <label class="film-label">{{ $item->judul }}</label>
                                            <button class="btn-pesan" onclick="link('{{ route('order.create', $item->id) }}')">
                                                <i class="fa-solid fa-cart-shopping"></i> Pesan
                                            </button>
                                        </div>
                                        
                                    </div>
                                    
                                @empty
                                    <p>Film tidak ada.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="news-container">
                    <h2>Berita</h2>
                    <div class="row">
                        <!-- Berita 1 -->
                        <div class="news-card col-md-4">
                            <img src="https://via.placeholder.com/800x400" alt="Berita 1">
                            <div class="news-body">
                                <h5 class="news-title">Judul Berita 1</h5>
                                <p class="news-text">Deskripsi berita 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
                                <p class="news-time">Jam Tayang: 10:00 AM</p>
                            </div>
                        </div>
                        
                        <!-- Berita 2 -->
                        <div class="news-card col-md-4">
                            <img src="https://via.placeholder.com/800x400" alt="Berita 2">
                            <div class="news-body">
                                <h5 class="news-title">Judul Berita 2</h5>
                                <p class="news-text">Deskripsi berita 2. Donec vel sapien quis massa dictum consequat. Nullam at lacus a dolor facilisis malesuada.</p>
                                <p class="news-time">Jam Tayang: 12:00 PM</p>
                            </div>
                        </div>
                        
                        <!-- Berita 3 -->
                        <div class="news-card col-md-4">
                            <img src="https://via.placeholder.com/800x400" alt="Berita 3">
                            <div class="news-body">
                                <h5 class="news-title">Judul Berita 3</h5>
                                <p class="news-text">Deskripsi berita 3. Integer id dolor nec ligula egestas tincidunt. Sed consequat urna et velit elementum consectetur.</p>
                                <p class="news-time">Jam Tayang: 02:00 PM</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Placeholder jika tidak ada berita -->
                    {{-- @if ($news->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Tidak ada berita saat ini.
                        </div>
                    @endif --}}
                </div>

                @foreach ($detail as $item)
                    <div class="modal fade" id="filmModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="filmModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filmModalLabel{{ $item->id }}">{{ $item->judul }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <p>Tanggal Rilis: {{ $item->tanggalRilis }}</p>
                                        <p>Perusahaan Produksi: {{ $item->perusahaanProduksi }}</p>
                                        <p>{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var myCarousel = document.querySelector('#film');
                        var carousel = new bootstrap.Carousel(myCarousel, {
                            interval: 2000,
                            wrap: true
                        });
                    });

                    function link(url) {
                        window.location.href = url;
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
