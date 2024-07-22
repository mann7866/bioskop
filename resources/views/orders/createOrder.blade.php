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

        .card-img-top {
            max-width: 100%;
            height: auto;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-submit {
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            .btn-submit {
                margin-top: 15px;
            }
        }
    </style>

    <form action="{{ route('order.store', $detail->id) }}" method="POST">
        @csrf

        <div class="container mt-4">
            <div class="form-container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <img id="imagePreview" src="{{ asset('image/' . $detail->foto) }}" class="card-img-top" alt="{{ $detail->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $detail->judul }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Rp. {{ number_format($detail->harga) }}</h6>
                                <p class="card-text">{{ $detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $detail->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Uncomment if you have "Asal Kota" dropdown
                        <div class="mb-3">
                            <label class="form-label">Asal Kota</label>
                            <select class="form-select @error('id_hargaOngkir') is-invalid @enderror" name="id_hargaOngkir" aria-label="Select Origin City">
                                <option selected disabled>Asal Kota</option>
                                @foreach ($hargaOngkir as $item)
                                    <option value="{{ $item->id }}">{{ $item->kota }}</option>
                                @endforeach
                            </select>
                            @error('id_hargaOngkir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        --}}

                        <button class="btn btn-primary btn-submit" type="submit" name="submit">Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
