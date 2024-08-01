@extends('layouts.app')

@section('content')
    <style>
        /* Styling khusus untuk form */
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
            font-weight: bold;
        }

        .total-payment-amount {
            font-size: 1.2rem;
            color: #000;
        }

        .no-order-message {
            margin-top: 50px;
            font-size: 1.5rem;
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
    </style>
    {{-- data yang ambil dari ordercontroller --}}

    @php
        function getBadgeClass($status)
        {
            switch ($status) {
                case 'paid':
                    return 'badge rounded-pill text-bg-success';
                case 'cancel':
                    return 'badge rounded-pill text-bg-danger';
                default:
                    return 'badge rounded-pill text-bg-secondary';
            }
        }
    @endphp
    @if (session('canceli'))
        <div class="toast-container mt-5 position-fixed top-0 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert" aria-live="assertive"
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
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
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
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
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
                    <div class="col-4">
                        <div class="card">
                            <img src="{{ asset('image/' . $item->detail->foto) }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h4 class="card-category ">Judul:</h4>
                                <h5 class="">{{ $item->detail->judul }}</h5>
                                <div class="card-category">Genres:</div>
                                <ul class="list-inline">
                                    @foreach ($item->detail->genres as $genre)
                                        <li class="list-inline-item"><span
                                                class="badge text-bg-info badge-genre">{{ $genre->genre }}</span></li>
                                    @endforeach
                                </ul>
                                <h4 class="card-category ">Harga:</h4>
                                <h6 class="">Rp. {{ number_format($item->detail->harga) }}</h6>
                                <h4 class="card-category ">Deskripsi:</h4>
                                <p class="card-text">{{ $item->detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                {{-- data di ambil dari atas dan kirim kan ke bawah --}}
                                <div>
                                    <span
                                        class="{{ getBadgeClass($item->status) }} mb-3">{{ ucfirst($item->status) }}</span>
                                </div>
                                <label for="" class="total-payment-label">Studio:</label>
                                @if ($item->studio)
                                    <h6 class="badge border border-primary text-primary">
                                        {{ $item->studio->studio }}
                                    </h6>
                                @else
                                    <p> studio sedang error dan tidak bisa tampil</p>
                                @endif
                                <label for="" class="total-payment-label">Kursi Yang Dipilih:</label>
                                @if ($item->kursi)
                                
                                @foreach ($kursi as $item)
                                <h6 class="badge border border-primary text-primary">
                                    {{ $item->kursi}}
                                </h6>
                                @endforeach

                                @else
                                    <p> kursi sedang error dan tidak bisa tampil</p>
                                @endif

                                <label for="" class="total-payment-label">Total Pembayaran:</label>
                                <div>
                                    <h6 class="badge border border-primary text-primary">Rp.
                                        {{ number_format($item->total_harga) }}</h6>
                                </div>
                                <label for="" class="total-payment-label">Total Tiket:</label>
                                <div>
                                    <h6 class="badge border border-secondary text-secondary">
                                        {{ $item->jumlah_tiket }}</h6>
                                </div>

                                @if ($item->status !== 'pending' && $item->status !== 'cancel')
                                    <div>
                                        <label for="" class="total-payment-label">Total Bayar:</label>
                                        <div>
                                            <h6 class="badge border border-success text-success">Rp.
                                                {{ number_format($item->pembayaran) }}</h6>
                                        </div>
                                    </div>
                                    <label for="" class="total-payment-label">Kembalian:</label>
                                    <div>
                                        <h6 class="badge border border-warning text-warning">Rp.
                                            {{ number_format($item->kembalian) }}</h6>
                                    </div>
                                @endif

                                @if ($item->status !== 'paid' && $item->status !== 'cancel')
                                    {{-- <div class="button-container d-flex justify-content-between"> --}}
                                    <a class="btn btn-danger" href="{{ route('order.delete', $item->id) }}"
                                        onclick="return confirm('yakin ingin Membatalkan Pesanan')">
                                        Hapus
                                    </a>
                                    <form action="{{ route('paid', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success">Bayar</button>
                                    </form>
                                    {{-- </div> --}}
                                @endif

                                @if ($item->status == 'cancel')
                                    <a class="btn btn-danger" href="{{ route('order.delete', $item->id) }}"
                                        onclick="return confirm('yakin ingin Membatalkan Pesanan')">
                                        Hapus
                                    </a>
                                @endif

                                @if ($item->status == 'paid')
                                    <form action="{{ route('cancel', $item->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="separator">
            @empty
                <h1 class="text-center text-secondary no-order-message">Tidak Ada Film Yang di Order</h1>
            @endforelse
        </div>
    </div>
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
            }, 1000);
        });
    </script>
@endsection
