@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="toast-container position-fixed top-5 end-0 p-3" style="z-index: 11">
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

    <style>
        /* .warning:hover {
                border-radius: 25px 27px;
            } */
        .warning {
            background-color: blue;
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
            background-color: royalblue;
            transition: all 0.3s;
        }

        .warning:hover::after {
            background-color: red;
            left: 0;
            width: 100%;
        }

        .toast-container {
            max-widht: 300px;
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
    </style>
    <div>
        <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('genre.create') }}">
            <i class="fas fa-plus"></i> Tambah Genre
        </a>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title text-center"><i class="fas fa-film"></i> Daftar Genre</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="genreTable" width="100%"
                    cellspacing="0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">Genre</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genre as $item)
                            <tr>
                                <td class="text-center">{{ $item->genre }}</td>
                                <td class="text-center">
                                    <a href="{{ route('genre.edit', $item->id) }}" class="btn btn-success btn-sm">
                                        <ion-icon name="pencil-outline"></ion-icon>
                                    </a>
                                    <a href="{{ route('genre.delete', $item->id) }}">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
<script>
    $(document).ready(function() {
        setTimeout(function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast-container'));
            var toastList = toastElList.map(function(setTimeout(() => {
                toastEl
            }, timeout);) {
                return new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 2000
                }).show();
            });
        }, 2000);
    });
</script>
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
