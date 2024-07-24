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
    </style>


    @if (session('delete'))
    <div class="alert alert-danger mt-3">
        {{ session('delete') }}
    </div>


    @endif

    <div class="container mt-4">
        <div class="form-container">
            @foreach ($order as $item)
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $item->detail->foto) }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->detail->judul }}</h5>
                                <h6 class="">Rp. {{ number_format($item->detail->harga) }}</h6>
                                <p class="card-text">{{ $item->detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <label for="">Total Pembayaran</label>
                                    <h6 class="">{{ $item->total_harga }}</h6>
                                </div>

                                <a class="btn btn-danger" href="{{ route('delete.order', $item->id) }}"  onclick="return confirm('yakin ingin Membatalkan Pesanan')">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr> <!-- Tambahkan garis pemisah antar pesanan -->
            @endforeach
        </div>
    </div>
@endsection
