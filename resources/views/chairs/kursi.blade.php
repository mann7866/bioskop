@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex mb-4">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search"
            required>
        <button class="btn btn-outline-primary" type="submit">Cari</button>
        <a class="btn btn-outline-secondary ms-2" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection

@section('content')
    <style>
        /* Styling untuk modal dan kursi */
        * {
            scroll-behavior: smooth;
            font-family: Arial, sans-serif;
        }

        .modal-content {
            border-radius: 25px;
            padding: 27px;

        }

        .kursi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .kursi-card {
            margin: 25px;
            width: 80px;
            height: 80px;
            background-color: #1a8bb8;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            cursor: progress;
            transition: background-color 0.3s, transform 0.3s;
            position: relative;
            text-align: center;
        }

        .kursi-card:hover {
            transform: scale(1.1);
        }

        .kursi-card.selected {
            background-color: #4caf50;
            color: white;
        }

        .kursi-card.reserved {
            background-color: #f44336;
            color: white;
            cursor: not-allowed;
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .film-card {
            background-color: #0d3e83;
            /* border: 1px solid #0f0303;    */
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .film-card:hover {
            background-color: #147dc8;
            transform: scale(1.05);
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
            position: absolute;
            bottom: -30px;
            width: 100%;
        }

        .button-group .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            border: none;
            background: none;
            text-decoration: none;
            color: inherit;
        }

        .button-group .btn-edit {
            position: relative;
            padding: 10%;
            margin: 15px;
            background-color: #14c14b;
            color: black;
            top: 17px;
            left: -10px;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* button ya  */
        .button-group .btn-edit a {
            color: black;
        }

        .button-group .btn-edit:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .button-group .btn-delete {
            position: relative;
            padding: 10%;
            margin: 15px;
            background-color: #dc3545;
            color: white;
            top: 17px;
            left: 12px;
            border-radius: 20px;
            /* border-radius: 20px; */
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button-group .btn-delete a {
            color: white;
        }

        .button-group .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .toast-container {
            z-index: 9999;
        }

        .toast {
            opacity: 1;
            transition: opacity 0.5s;
        }

        .toast.fade-out {
            opacity: 0;
        }

        .warning {
            /* border-block-start: 1rem solid;
            writing-mode: horizontal-tb; */
            background-clip: border-box;
            background-color: royalblue;
            border-radius: 15px;
            transition: 3s ease;
        }

        .warning:hover {
            border-radius: 30px 20px 15px;
        }
    </style>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="toast-container position-fixed top-5 end-0 p-2">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('gagal'))
        <div class="toast-container position-fixed top-5 end-0 p-2">
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('gagal') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- kursi Semua  --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Studio dan Kursi</h1>

                <a href="{{ route('kursi.create') }}" class="btn btn-primary mb-4 warning">Tambah Kursi</a>

                <div class="film-container">
                    @forelse ($studio as $studio)
                        <div class="film-card" data-bs-toggle="modal" data-bs-target="#studioModal{{ $studio->id }}">
                            <p>{{ $studio->studio }}</p>
                        </div>

                        <!-- Studio Modal -->
                        <div class="modal fade" id="studioModal{{ $studio->id }}" tabindex="-1"
                            aria-labelledby="studioModalLabel{{ $studio->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="studioModalLabel{{ $studio->id }}">Kursi Studio
                                            {{ $studio->studio }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="kursi-container">
                                            @forelse ($studio->kursi as $kursi)
                                                <div class="kursi-card @if ($kursi->is_reserved) reserved @endif"
                                                    data-seat="{{ $kursi->studio }}">
                                                    {{ $kursi->kursi }}
                                                    <div class="button-group">
                                                        <button class="btn btn-sm btn-edit">
                                                            <a href="{{ route('kursi.edit', $kursi->id) }}"><i
                                                                    class="bi bi-pen"></i></a>
                                                        </button>
                                                        <button class="btn btn-sm btn-delete">
                                                            <a href="{{ route('kursi.delete', $kursi->id) }}"
                                                                onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('delete-form-{{ $kursi->id }}').submit(); }">
                                                                <i class="bi bi-backspace-reverse"></i>
                                                            </a>
                                                        </button>
                                                        <form id="delete-form-{{ $kursi->id }}"
                                                            action="{{ route('kursi.delete', $kursi->id) }}" method="GET"
                                                            style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-center">Tidak ada kursi untuk studio ini</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-secondary">Tidak ada studio</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
        // Initialize DataTable if necessary
        // let table = new DataTable('#GO'); // Uncomment if needed

        // Initialize Toast notifications
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
