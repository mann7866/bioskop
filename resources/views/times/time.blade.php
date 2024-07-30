@extends('layouts.app')

@section('content')
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
    {{-- @if (session('delete'))
        <div class="toast-container position-fixed top-3 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('delete') }}
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

    <style>
        .pos {
            text-align: center;
            max-width: 300px;
            margin: 0 auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .warning {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #ccc;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .warning:hover {
            /* background-color: #ffcccc;
            border-color: #ff6666; */
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
            width: 100%;
            left: 0;
            background-color: red;
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

    <div class="container mt-4">
        <div class="d-flex mb-4">
            <a class="btn btn-primary warning" href="{{ route('time.create') }}">
                <i class="fas fa-plus"></i> Tambah Time
            </a>
        </div>
        <div class="card text-center">
            <div class="card-header">
                <h3>{{ __('Daftar Tayang') }}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-center">Jam Tayang</th>
                                <th class="text-center">Tanggal Tayang</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($time as $item)
                                <tr>
                                    <td class="text-center">{{ date('H:i', strtotime($item->jamTayang)) }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($item->tanggalTayang)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('time.edit', $item->id) }}" class="btn btn-success">
                                            <ion-icon name="pencil-outline"></ion-icon>
                                        </a>
                                        <a href="{{ route('time.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
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
@endsection
