@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
        <a class="btn btn-outline-primary" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection

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
            /* flex: 0 0 calc(16.66% - 20px); */
            box-sizing: border-box;
            border-radius: 10px;
            width: 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #0056b3;
        }

        .film-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .film-card img {
            width: 50px;
            /* height: 300px; */
            object-fit: cover;
            transition: transform 0.3s ease-out;
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

        .carousel-control-prev,
        .carousel-control-next {
            display: none;
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

        /* Animasi Modal */
        .modal.fade .modal-dialog {
            transform: translate(0, -100%);
            transition: transform 0.3s ease-out;
        }

        .modal.fade.show .modal-dialog {
            transform: translate(0, 0);
        }

        .modal-content {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header,
        .modal-footer {
            border: none;
        }

        .modal-footer {
            padding: 10px;
            justify-content: space-between;
        }

        .modal-footer .btn {
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .modal-footer .btn:hover {
            transform: scale(1.05);
        }
        .oke{
            width: 39px;
        }
        .text-center1{
            text-align: center;
            justify-content: space-between;
            position: absolute;
            left: 40%;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Kursi Film</h1>

                <a href="{{ route('kursi.create') }}" class="btn btn-primary btn-create">Tambah Film</a>

                <div id="filmCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="film-container">
                                @forelse ($kursi as $item)
                                    <div class="film-card text-center" data-bs-toggle="modal" data-bs-target="#filmModal{{ $item->id }}">
                                        <p class="mt-4"><strong>{{ $item->studio }}</strong></p>
                                        <div class="film-label-container">
                                            <label class="film-label">{{ $item->judul }}</label>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-secondary underline">Film Tidak ada</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($kursi as $item)
                    <!-- Film Modal -->
                    <div class="modal fade" id="filmModal{{ $item->id }}" tabindex="-1" aria-labelledby="filmModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center1" id="filmModalLabel{{ $item->id }}">Detail Film</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h6 class="oke" style="background-color: #007bff; color: #fff; padding: 10px; border-radius: 5px;">
                                            <strong>{{ $item->kursi }}</strong>
                                        </h6>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kursi.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this film?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('kursi.delete', $item->id) }}" method="GET">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var myCarousel = document.querySelector('#filmCarousel');
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
