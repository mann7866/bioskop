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
        <div class="toast-container position-fixed top-5 end-0 p-2" style="z-index: 11">
            <div class="toast align-items-center text-bg-denger  border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('delete') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mt-4">
        <div class="form-container">
            @forelse ($order as $item)
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <img src="{{ asset('image/' . $item->detail->foto) }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->detail->judul }}</h5>
                                <h2 class="card-category">Genres:</h2>
                                <ul>
                                    @foreach ($item->detail->genres as $genre)
                                        <li>{{ $genre->genre }}</li>
                                    @endforeach
                                </ul>

                                <h6 class="">Rp. {{ number_format($item->detail->harga) }}</h6>
                                <p class="card-text">{{ $item->detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">

                                <div>
                                    @if($item->status == 'paid')
                                    <p class="text-success">{{ $item->status }}</p>
                                    @endif
                                    @if($item->status == 'pending')
                                    <p class="text-warning">{{ $item->status }}</p>
                                    @endif
                                    @if($item->status == 'cancel')
                                    <p class="text-danger">{{ $item->status }}</p>
                                    @endif
                                </div>
                                <div>
                                    <label for="">Total Pembayaran</label>
                                    <h6 class="">Rp. {{ number_format($item->total_harga) }}</h6>
                                </div>

                                @if($item->status != 'paid'  && $item->status != 'cancel')
                                <div>
                                    <a class="btn btn-danger" href="{{ route('order.delete', $item->id) }}"
                                        onclick="return confirm('yakin ingin Membatalkan Pesanan')">
                                       Delete
                                    </a>
                                </div>

                                <form action="{{ route('paid', $item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success">Bayar</button>
                                </form>
                                @endif

                                @if($item->status == 'cancel')
                                <form action="{{ route('cancel', $item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endif

                                @if($item->status == 'paid')
                                <form action="{{ route('cancel', $item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <hr> <!-- Tambahkan garis pemisah antar pesanan -->
            @empty
                <h1 class="text-center text-secondary">Tidak Ada Film Yang di Order</h1>
            @endforelse
        </div>
    </div>
@endsection
