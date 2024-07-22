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
            flex: 0 0 calc(16.66% - 20px); /* Untuk menampilkan 6 kartu per baris dengan jarak */
            box-sizing: border-box;
            border-radius: 10px; /* Membuat sudut kartu lebih lembut */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan pada kartu */
        }

        .film-card img {
            width: 100%;
            height: 300px; /* Tinggi gambar */
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 10px 10px 0 0; /* Membuat sudut atas gambar lebih lembut */
        }

        .film-card:hover img {
            transform: scale(1.05); /* Efek zoom yang lebih halus */
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
            border-radius: 0 0 10px 10px; /* Membuat sudut bawah deskripsi lebih lembut */
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
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .film-card .btn-pesan:hover {
            background-color: #ff4757;
            transform: scale(1.05); /* Efek zoom yang lebih halus pada tombol */
        }

        .film-container {
            display: flex;
            flex-wrap: wrap; /* Membungkus baris */
            justify-content: flex-start; /* Kartu film ke kiri */
            padding: 10px;
        }

        .film-container::-webkit-scrollbar {
            display: none; /* Sembunyikan scrollbar untuk tampilan lebih bersih */
        }

        .poss {
            position: static;
        }

        .carousel-control-prev, .carousel-control-next {
            width: 5%;
        }

        .back {
            color: #ffffff;
            background-color: #000;
            object-fit: cover;
            background-clip: border-box;
            background: url({{ asset('image/netflix.jpg') }});
            border-radius: 10px; /* Membuat sudut kartu lebih lembut */
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div id="filmCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="film-container">
                                @forelse ($detail as $item)
                                    <div class="film-card" data-bs-toggle="modal" data-bs-target="#filmModal{{ $item->id }}">
                                        <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid" alt="{{ $item->judul }}">
                                        <button class="btn-pesan">
                                            <i class="fa-solid fa-cart-shopping"></i> Pesan
                                        </button>
                                        <div class="film-description">
                                            <h5 class="poss">{{ $item->judul }}</h5>
                                            <p>{{ $item->deskripsi }}</p>
                                        </div>
                                        <label class="film-label">{{ $item->judul }}</label>
                                    </div>
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

    {{-- Bootstrap Modals untuk masing-masing film --}}
    @foreach ($detail as $item)
        <div class="modal fade" id="filmModal{{ $item->id }}" tabindex="-1" aria-labelledby="filmModalLabel{{ $item->id }}" aria-hidden="true">
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
            var myCarousel = document.querySelector('#filmCarousel');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 2000,  // Mengatur interval pergeseran otomatis menjadi 2 detik
                wrap: true
            });
        });
    </script>
@endsection
