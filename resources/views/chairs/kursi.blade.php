@extends('layouts.app')

<style>
    /* Styling umum untuk form */
    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
    }

    .form-title {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card img {
        border-bottom: 2px solid #ddd;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
    }

    .card-text {
        color: #555;
    }

    .seats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }

    .seat {
        width: 50px;
        height: 50px;
        background-color: #e0f7fa;
        margin: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.3s;
        position: relative;
    }

    .seat:hover {
        transform: scale(1.1);
    }

    .seat::after {
        content: attr(data-seat);
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 2px 5px;
        border-radius: 4px;
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .seat:hover::after {
        opacity: 1;
    }

    .seat.selected {
        background-color: #4caf50;
        color: white;
    }

    .seat.reserved {
        background-color: #f44336;
        cursor: not-allowed;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .form-label {
        font-weight: bold;
    }

    .total-seats {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }
</style>

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
        <a class="btn btn-outline-primary" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection

<link rel="stylesheet" href="{{ asset('css/kursi.css') }}">
@section('content')
    {{-- alert --}}
    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Kursi Film</h1>

                <a href="{{ route('kursi.create') }}" class="btn btn-primary btn-create">Tambah Kursi</a>

                <div class="film-container">
                    @forelse ($kursi as $studioId => $kursis)
                        @foreach ($kursis->chunk(10) as $chunk)
                            <div class="kursi-row">
                                @foreach ($chunk as $item)
                                    <div class="kursi-item">
                                        <strong>{{ $item->kursi }}</strong>
                                        <div class="button-group">
                                            <button class="btn btn-sm btn-edit">
                                                <a href="{{ route('kursi.edit', $item->id) }}"><i class="bi bi-pen"></i></a>
                                            </button>
                                            <button class="btn btn-sm btn-delete">
                                                <a href="{{ route('kursi.delete', $item->id) }}"><i class="bi bi-backspace-reverse"></i></a>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @empty
                        <div class="text-center">
                            <p class="text-secondary">Tidak ada kursi yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <style>
            .fade-out {
                opacity: 0;
                transition: opacity 0.5s ease-out;
            }
        </style>
    @endpush
    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    @endpush

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table = new DataTable('#GO');
            setTimeout(function() {
                var toastElList = document.querySelectorAll('.toast');
                toastElList.forEach(function(toastEl) {
                    var toast = new bootstrap.Toast(toastEl, {
                        autohide: true,
                        delay: 2000
                    });
                    toast.show();

                    setTimeout(function() {
                        toastEl.classList.add('fade-out');
                    }, 2000);
                });
            }, 2000);
        });
    </script>
@endsection
