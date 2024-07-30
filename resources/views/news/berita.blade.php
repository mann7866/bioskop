@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="toast-container position-fixed top-3 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('delete'))
        <div class="toast-container position-fixed top-3 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('delete') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <style>
        .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 2s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateY(-20px);
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

        .film-label-container {
            display: flex;
            justify-content: space-between;
            padding: 10px;
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

    <div class="news-container">
        <h1 class="text-center text-secondary underline">Berita Film</h1>
        <a href="{{ route('berita.create') }}">
            <button type="button" class="btn-create">Tambah Berita</button>
        </a>
        <div class="row">
            @foreach ($berita as $item)
                <div class="news-card col-md-4">
                    <img src="{{ asset('imageBerita/' . $item->foto_deskripsi) }}" class="img-fluid"
                        alt="{{ $item->judul }}">
                    <div class="news-body">
                        <h5 class="news-title">{{ $item->judul }}</h5>
                        <p class="news-text">{{ $item->deskripsi }}</p>
                     
                    </div>
                    <div class="film-label-container">
                        <a href="{{ route('berita.edit', $item->id) }}">
                            <button type="button" class="btn-edit">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                        </a>
                        <form action="{{ route('berita.delete', $item->id) }}" method="GET"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                // Ambil semua elemen toast di halaman
                var toastElList = document.querySelectorAll('.toast');
                // Iterasi melalui setiap elemen toast dan tampilkan
                toastElList.forEach(function(toastEl) {
                    var toast = new bootstrap.Toast(toastEl, {
                        autohide: true,
                        delay: 2000
                    });
                    toast.show();

                    // Add fade-out class after showing
                    setTimeout(function() {
                        toastEl.classList.add('fade-out');
                    }, 2000); // Wait until the toast has fully shown before starting fade-out
                });
            }, 2000); // Tunggu 2 detik sebelum menampilkan toast
        });
    </script>
@endsection
