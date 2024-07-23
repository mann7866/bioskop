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
        .warning {
            position: relative;
            background-color: blue;
            transition: 2s ease;
            overflow: hidden;
        }

        .warning::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: red;
            transition: all 0.4s;
        }

        .warning:hover::after {
            left: 0;
            width: 100%;
        }

        .toast-container {
            max-width: 300px;
            /* Adjust width as needed */
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
        <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('kursi.create') }}">
            <i class="fas fa-plus"></i> Tambah kursi
        </a>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title text-center"><i class="fas fa-chair"></i> Daftar kursi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="kursiTable" width="100%"
                    cellspacing="0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">Kursi</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kursi as $item)
                            <tr>
                                <td class="text-center">{{ $item->kursi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kursi.delete', $item->id) }}">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl, {
                        autohide: true,
                        delay: 2000
                    }).show();
                });
            }, 2000); // Ubah 2000 menjadi waktu delay yang diinginkan dalam milidetik
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
