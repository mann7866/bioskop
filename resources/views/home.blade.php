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
            /* For displaying 6 cards per row with spacing */
            box-sizing: border-box;
            border-radius: 10px;
            /* Rounded corners for the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Shadow for the card */
        }

        .film-card img {
            width: 100%;
            height: 300px;
            /* Height of the image */
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 10px 10px 0 0;
            /* Rounded top corners of the image */
        }

        .film-card:hover img {
            transform: scale(1.05);
            /* Smooth zoom effect on hover */
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
            /* Rounded bottom corners for description */
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
            top: -10px;
            right: -10px;
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
            transform: scale(1.05);
            /* Smooth zoom effect on hover */
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            /* Wrapping rows */
            justify-content: flex-start;
            /* Align film cards to the left */
            padding: 10px;
        }

        .film-container::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for cleaner appearance */
        }

        .pos {
            position: static;
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
            /* Rounded corners for the card */
        }

        /* Carousel */
        .carousel-inner img {
            border-radius: 20px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* Media queries for responsiveness */
        @media (max-width: 1200px) {
            .film-card {
                flex: 0 0 calc(20% - 20px);
                /* For 5 cards per row */
            }
        }

        @media (max-width: 992px) {
            .film-card {
                flex: 0 0 calc(25% - 20px);
                /* For 4 cards per row */
            }
        }

        @media (max-width: 768px) {
            .film-card {
                flex: 0 0 calc(33.33% - 20px);
                /* For 3 cards per row */
            }
        }

        @media (max-width: 576px) {
            .film-card {
                flex: 0 0 calc(50% - 20px);
                /* For 2 cards per row */
            }

            .carousel-inner img {
                height: 150px;
                /* Adjust carousel image height */
            }
        }

        @media (max-width: 400px) {
            .film-card {
                flex: 0 0 calc(100% - 20px);
                /* For 1 card per row */
            }

            .carousel-inner img {
                height: 120px;
                /* Further adjust carousel image height */
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
                                    <button class="btn-pesan pos" data-id="{{ $item->id }}">
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

        document.querySelectorAll('.btn-pesan').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                event.preventDefault();

                var filmId = this.getAttribute('data-id');
                var url = '{{ route('order.create', ':id') }}'.replace(':id', filmId);

                // Melakukan AJAX request untuk pemesanan
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert('Pemesanan berhasil!');
                      } else {
                          alert('Pemesanan gagal!');
                      }
                  }).catch(error => {
                      console.error('Error:', error);
                      alert('Terjadi kesalahan, coba lagi nanti.');
                  });
            });
        });
    });
</script>
@endsection
