@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
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


        .kursi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .kursi-item {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 150px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .kursi-item:hover {
            transform: scale(1.05);
        }

        .kursi-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 0.5s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateY(-50px);
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

    <div>
        <a class="btn btn-primary btn-create mt-5 m-2" href="{{ route('kursi.create') }}">
            Tambah kursi
        </a>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title text-center"><i class="fas fa-chair"></i> Daftar kursi</h4>
        </div>
        <div class="card-body">
            <div class="kursi-container">
                @foreach ($kursi as $item)
                    <div class="kursi-item">
                        <div>{{ $item->kursi }}</div>
                        <div class="kursi-actions">
                            <a href="{{ route('kursi.edit', $item->id) }}" class="btn btn-success btn-sm">
                                <ion-icon name="pencil-outline"></ion-icon>
                            </a>
                            <a href="{{ route('kursi.delete', $item->id) }}">
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
