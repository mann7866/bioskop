@extends('layouts.app')

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
