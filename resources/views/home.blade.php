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
            cursor: pointer;
            margin: 10px;
            flex: 0 0 calc(16.66% - 20px);
            /* Menampilkan 6 kartu per baris dengan jarak */
            box-sizing: border-box;
            border-radius: 10px;
            /* Sudut yang membulat pada kartu */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Bayangan untuk kartu */
        }

        .film-card img {
            width: 100%;
            height: 300px;
            /* Tinggi gambar */
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 10px 10px 0 0;
            /* Sudut atas gambar membulat */
        }

        .film-card:hover img {
            transform: scale(1.05);
            /* Efek zoom halus saat hover */
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
            /* Sudut bawah deskripsi membulat */
        }

        .film-card:hover .film-description {
            opacity: 1;
        }

        .film-label-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Pusatkan label dan tombol di tengah */
            margin: 10px;
            /* Jarak untuk memberi ruang pada elemen lain */
        }

        .film-label {
            margin: 0;
            /* Menghapus margin untuk label */
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
            opacity: 0.9; /* Latar belakang semi-transparan */
            margin-top: 10px; /* Jarak atas dari label */
        }

        .btn-pesan:hover {
            background-color: #ff4757;
            transform: scale(1.05);
            /* Efek zoom halus saat hover */
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            /* Membungkus baris */
            justify-content: flex-start;
            /* Menyelaraskan kartu film ke kiri */
            padding: 10px;
        }

        .film-container::-webkit-scrollbar {
            display: none;
            /* Sembunyikan scrollbar untuk tampilan lebih bersih */
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .back {
            color: #ffffff;
            background-color: #000;
            object-fit: cover;
            background-clip: border-box;
            background: url({{ asset('image/netflix.jpg') }});
            border-radius: 10px;
            /* Sudut membulat untuk kartu */
        }

        /* Carousel */
        .carousel-inner img {
            border-radius: 20px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .carousel-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* Media queries untuk responsivitas */
        @media (max-width: 1200px) {
            .film-card {
                flex: 0 0 calc(20% - 20px);
                /* Untuk 5 kartu per baris */
            }
        }

        @media (max-width: 992px) {
            .film-card {
                flex: 0 0 calc(25% - 20px);
                /* Untuk 4 kartu per baris */
            }
        }

        @media (max-width: 768px) {
            .film-card {
                flex: 0 0 calc(33.33% - 20px);
                /* Untuk 3 kartu per baris */
            }
        }

        @media (max-width: 576px) {
            .film-card {
                flex: 0 0 calc(50% - 20px);
                /* Untuk 2 kartu per baris */
            }

            .carousel-inner img {
                height: 150px;
                /* Menyesuaikan tinggi gambar carousel */
            }
        }

        @media (max-width: 400px) {
            .film-card {
                flex: 0 0 calc(100% - 20px);
                /* Untuk 1 kartu per baris */
            }

            .carousel-inner img {
                height: 120px;
                /* Menyesuaikan lebih tinggi gambar carousel */
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center mb-4 back">
                    <div class="card-header">{{ __('Bioskop') }}</div>
                    <div class="card-body">
                        <p>{{ __('Welcome to Bioskop') }}</p>
                    </div>
                </div>

                <!-- Carousel untuk gambar besar -->
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
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#smallCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Carousel untuk kartu film -->
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
                                        </div>
                                    </div>
                                    <button class="btn-pesan" onclick="link('{{ route('order.create', $item->id) }}')">
                                        <i class="fa-solid fa-cart-shopping"></i> Pesan
                                    </button>
                                @empty
                                    <p>Film tidak ada.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modals untuk masing-masing film -->
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
                interval: 2000, // Mengatur interval pergeseran otomatis menjadi 2 detik
                wrap: true
            });
        });

        function link(url) {
            window.location.href = url;
        }
    </script>
@endsection
