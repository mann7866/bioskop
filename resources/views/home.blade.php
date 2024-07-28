@extends('layouts.main')

@section('search')
<<<<<<< Updated upstream
<form action="{{ route('home') }}" method="GET" class="d-flex">
    <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film"
        aria-label="Search" required>
    <a class="btn btn-outline-success" href="{{ route('detail') }}">Refresh</a>
</form>
=======
    <form action="{{ route('home') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
        <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>
>>>>>>> Stashed changes
@endsection
@include('Componen.home_css')
@section('content')
  
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>NihonFlix</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div id="filmCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($detail as $key => $item)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('image/' . $item->foto) }}" class="d-block w-100" alt="{{ $item->judul }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#filmCarousel" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#filmCarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
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
                                            <button class="btn-pesan"
                                                onclick="link('{{ route('order.create', $item->id) }}')">
                                                <i class="fa-solid fa-cart-shopping"></i> Pesan
                                            </button>
                                        </div>
                                        <div class="film-label-container">
                                            <label class="film-label">{{ $item->judul }}</label>
                                        </div>
                                    </div>

                                @empty
                                    <p class="text-center text-secondary">Tidak Ada Film Yang di Upload</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h2>Berita</h2>
                        <div class="row">
                            @foreach ($berita as $item)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('imageBerita/' . $item->foto_deskripsi) }}" class="card-img-top" alt="{{ $item->judul }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->judul }}</h5>
                                            <p class="card-text">{{ $item->deskripsi }}</p>
                                            <p class="card-text"><small class="text-muted">Tanggal Tayang: {{ $item->tanggal }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($berita->isEmpty())
                                <p class="text-center text-secondary">Tidak Ada Berita Hari Ini</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#filmCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            wrap: true
        });
    });

    function link(url) {
        window.location.href = url;
    }
</script>
