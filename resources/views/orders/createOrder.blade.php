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

    <form action="{{ route('order.store', $detail->id) }}" method="POST">
        @csrf

    <div class="container mt-4" <div class="form-container">
        <div class="row">

            <div class="col-4">
                <div class="card">
                    <div class="col-12">
                        <div class="mb-3">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="imagePreview" src="{{ asset('image/' .$detail->foto) }}" class="mt-2" style="max-width: 200px; max-height: 200px; display: block;">
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $detail->judul }}</h5>
                        <h6 class="">Rp. {{ number_format($detail->harga) }}</h6>
                        <p class="card-text">{{ $detail->judul }}</p>
                    </div>
                </div>
            </div>

            <div class="col-8">


                    <div class="mb-3">
                        <label class="form-label">judul</label>

                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul"value="{{ $detail->judul }}">
                        </select>
                        @error('id_judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{--  <div class="mb-3">
                            <label class="form-label">Asal Kota</label>
                            <select class="mt-3 form-select @error('id_hargaOngkir') is-invalid @enderror"
                                    aria-label="Select Origin City" name="id_hargaOngkir">
                                <option selected disabled>Asal Kota</option>
                                @foreach ($hargaOngkir as $item)
                                    <option value="{{ $item->id }}">{{ $item->kota }}</option>
                                @endforeach
                            </select>
                            @error('id_hargaOngkir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>  --}}

                    <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit ">
                        Order
                    </button>


            </div>
        </div>

    </div>
    </div>
</form>
@endsection
