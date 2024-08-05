@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search"
            required>
        <a class="btn btn-outline-primary" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection
@if (session('delete'))
<div class="toast-container mt-5 position-fixed top-3 end-0 p-2" style="z-index: 11">
    <div class="toast mt-3 align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('delete') }}
            </div>
        </div>
    </div>
</div>
@endif
@if (session('success'))
    <div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
        <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif
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

        .modal-footer {
            display: flex;
            justify-content: space-between;
        }

        .btn-create,
        .btn-edit,
        .btn-delete {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-create:hover,
        .btn-edit:hover,
        .btn-delete:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-create {
            margin-bottom: 20px;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .warning {
            color: white;
            transition: 2s ease;
            position: relative;
            overflow: hidden;
        }

        .warning::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            transition: all 0.3s;
        }

        .warning:hover::after {
            background-color: red;
            left: 0;
            width: 100%;
        }

        .sok {
            border-radius: 20px;
        }
        .slide-down {
        animation: slide-down 2s ease 0s 1 normal forwards;
    }
    @keyframes slide-down {
        from {
            transform: translateZ(-9.7rem);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .fade-out {
        animation: fade-out 1s ease forwards;
    }

    @keyframes fade-out {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
    </style>


    {{--  tampilan untuk search  --}}

    {{--  <a href="{{route('home')}}" class="btn btn-outline-danger m-3">Back</a>  --}}

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @endpush
    {{--  end tampilan searc  --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Detail Film</h1>

                <a href="{{ route('detail.create') }}" class="btn btn-primary btn-create ">Tambah Film</a>

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
                                            <p class="poss">{{ $item->judul }}</p>

                                            @if ($timeCount > 0)
                                            <h6><strong>Tanggal Tayang:</strong></h6>
                                            <p class="text-muted">{{ $item->time->tanggalTayang }}</p>

                                            @endif

                                        </div>

                                        <div class="film-label-container">
                                            <label class="film-label">{{ $item->judul }}</label>
                                            @if ($timeCount > 0)
                                            <h6><strong>Tanggal Tayang:</strong></h6>
                                            <p class="text-muted">{{ $item->time->tanggalTayang }}</p>

                                            @endif

                                        </div>
                                    </div>
                                @empty
                                    <p class="text-secondary underline">FIlm Tidak ada</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($detail as $item)
                    <!-- Film Modal -->
                    <div class="modal fade" id="filmModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="filmModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filmModalLabel{{ $item->id }}">{{ $item->judul }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                                        <img src="{{ asset('image/' . $item->foto) }}" class="img-fluid"
                                            alt="{{ $item->judul }}">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <h6><strong>Genre:</strong></h6>
                                        <ul class="list-unstyled">
                                            @foreach ($item->genres as $genre)
                                                <li class="text-secondary">{{ $genre->genre }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <h6><strong>Tanggal Rilis:</strong></h6>
                                        <p class="text-muted">{{ $item->tanggalRilis }}</p>
                                        @if ($timeCount > 0)
                                        <h6><strong>Tanggal Tayang:</strong></h6>
                                        <p class="text-muted">{{ $item->time->tanggalTayang }}</p>
                                        <h6><strong>Jam Tayang:</strong></h6>
                                        <p class="text-muted">{{ $item->time->jamTayang }}</p>
                                        @endif

                                    </div>
                                    <div class="mb-3">
                                        <h6><strong>Perusahaan Produksi:</strong></h6>
                                        <p>{{ $item->perusahaanProduksi }}</p>
                                    </div>
                                    <div>
                                        <h6><strong>Deskripsi:</strong></h6>
                                        <p>{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('detail.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('detail.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        <a href="{{ route('detail') }}"> <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button></a>

                                    </form>
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
