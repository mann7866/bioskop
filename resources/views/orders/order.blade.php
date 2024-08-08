@extends('layouts.app')

@section('content')
    <style>
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            margin-bottom: 20px;
        }

        .card-category {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }

        .toast-container {
            position: fixed;
            top: 5px;
            right: 0;
            padding: 20px;
            z-index: 11;
        }

        .toast-body {
            font-size: 1rem;
        }

        .card-title,
        .card-text {
            margin-bottom: 10px;
        }

        .btn-danger,
        .btn-success {
            margin-top: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .btn-danger:hover,
        .btn-success:hover {
            transform: scale(1.05);
        }

        .separator {
            margin: 40px 0;
        }

        .total-payment-label {
            position: relative;
            display: flex;
            font-weight: bold;
        }

        .total-payment-amount {
            font-size: 1.2rem;
            color: #000;
        }

        .no-order-message {
            margin-top: 50px;
            font-size: 1.5rem;
            color: #666;
        }

        .card-category {
            margin-bottom: 10px;
            color: #555;
        }

        .badge-genre {
            font-size: 0.9rem;
            margin-right: 5px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .toast-container {
            position: fixed;
            max-width: 300px;
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

        .badge {
            padding: 0.4em 0.8em;
            font-size: 0.9em;
        }

        .warna {
            position: relative;
            left: 7px;
            top: 20px;
        }
    </style>

    @php
        function getBadgeClass($status)
        {
            switch ($status) {
                case 'paid':
                    return 'badge rounded-pill bg-success';
                case 'cancel':
                    return 'badge rounded-pill bg-danger';
                default:
                    return 'badge rounded-pill bg-secondary';
            }
        }
    @endphp

    @if (session('canceli'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center bg-success text-white border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('canceli') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('cancel'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center bg-success text-white border-0 show slide-down" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('cancel') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center bg-success text-white border-0 show slide-down" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mt-4">
        <div class="form-container">
            @forelse ($order as $item)
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('image/' . $item->detail->foto) }}" class="card-img-top" alt="{{ $item->detail->judul }}">
                            <div class="card-body">
                                <div class="card-category">Genres:</div>
                                <ul class="list-inline">
                                    @foreach ($item->detail->genres as $genre)
                                        <li class="list-inline-item"><span class="badge bg-info badge-genre">{{ $genre->genre }}</span></li>
                                    @endforeach
                                </ul>
                                <h4 class="card-category">Harga:</h4>
                                <h6>Rp. {{ number_format($item->detail->harga, 0, ',', '.') }}</h6>
                                <h4 class="card-category">Deskripsi:</h4>
                                <p class="card-text">{{ $item->detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="warna">
                                <span class="{{ getBadgeClass($item->status) }} mb-3">{{ ucfirst($item->status) }}</span>
                            </div>
                            <div class="card-body">
                                <h4 class="card-category">Judul:</h4>
                                <h5 class="text-muted">{{ $item->detail->judul }}</h5>
                                <h6><strong>Tanggal Tayang:</strong></h6>
                                <p class="text-muted">{{ $item->detail->tanggal->tanggalTayang }}</p>
                                <h6><strong>Jam Tayang:</strong></h6>
                                <p class="text-muted">{{ $item->detail->time->jamTayang }}</p>
                                <div class="d-flex">
                                    <h6 style="margin-right: 10px"><strong>Studio</strong></h6>
                                    <h6><strong>Kursi</strong></h6>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <h6 class="badge bg-light text-secondary border border-secondary">{{ $item->detail->studio->studio }}</h6>
                                    </div>
                                    <ul class="list-unstyled d-flex flex-wrap">
                                        @foreach ($item->kursi as $kursi)
                                            <h6 class="badge bg-light text-secondary border border-secondary me-1">{{ $kursi->kursi }}</h6>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <label class="total-payment-label">Total Tiket:</label>
                                    <div>
                                        <h6 class="badge bg-light text-secondary border border-secondary">{{ $item->jumlah_tiket }}</h6>
                                    </div>
                                </div>
                                <label class="total-payment-label">Total Pembayaran:</label>
                                <div>
                                    <h6 class="badge bg-light text-primary border border-primary">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</h6>
                                </div>
                                @if ($item->status !== 'paid' && $item->status !== 'cancel')
                                    <form action="{{ route('paid', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success">Bayar</button>
                                    </form>
                                    <form action="{{ route('cancel', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-order-message">
                    <p>No order data available.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
