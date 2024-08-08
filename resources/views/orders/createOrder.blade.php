@extends('layouts.app')

<style>
    /* Styles for the studio and seat selection */
    .studio-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .studio-card {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    .studio-card:hover {
        background-color: #e9ecef;
        transform: scale(1.02);
    }

    .studio-card input[type="radio"] {
        margin-right: 10px;
    }

    .studio-card label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
    }

    .kursi-item {
        position: relative;
        width: 50px;
        height: 50px;
        background-color: #e0f7fa;
        margin: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .kursi-item.selected {
        background-color: #4caf50;
        color: white;
    }

    .kursi-item.reserved {
        background-color: #f44336;
        cursor: not-allowed;
    }

    .kursi-item::after {
        content: attr(title);
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 3px;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s;
        z-index: 10;
    }

    .kursi-item:hover::after {
        opacity: 1;
        visibility: visible;
    }

    .film-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .film-card {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        width: calc(25% - 10px);
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    .film-card:hover {
        background-color: #e0e0e0;
        transform: scale(1.05);
    }

    .film-label {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .kursi-item input[type="checkbox"] {
        display: none;
    }

    .kursi-row {
        margin-bottom: 10px;
    }

    .modal-dialog {
        max-width: 80%;
    }
</style>

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Film Detail -->
                    <div class="card">
                        <img src="{{ asset('image/' . $detail->foto) }}" class="img-fluid" alt="{{ $detail->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $detail->judul }}</h5>
                            <h5 class="card-categori">Genres:</h5>
                            <ul>
                                @foreach ($detail->genres as $genre)
                                    <li class="badge text-bg-info" style="list-style:none;">{{ $genre->genre }}</li>
                                @endforeach
                            </ul>
                            <h6><strong>Studio:</strong></h6>
                            <p class="text-muted badge border border-primary">{{ $detail->studio->studio }}</p>
                            <div class="d-flex">
                                <h6><strong>Tayang pada </strong></h6>
                            </div>
                            <div class="d-flex">
                                <p class="text-muted badge border border-primary">{{ $detail->tanggal->tanggalTayang }}</p>
                                <p class="text-muted badge border border-primary">{{ $detail->time->jamTayang }}</p>
                            </div>

                            <h6>Harga Tiket Film :</h6>
                            <h6 class="text-muted badge border border-primary">Rp. {{ number_format($detail->harga) }}</h6>
                            <h6>Deskripsi :</h6>
                            <p class="card-text">{{ $detail->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                        @csrf
                        <input type="hidden" name="id_detail" value="{{ $detail->id }}">
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                                <input type="text" class="form-control @error('jumlah_tiket') is-invalid @enderror"
                                    id="jumlah_tiket_input" name="jumlah_tiket" readonly>
                                @error('jumlah_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror"
                                    id="total_harga_input" name="total_harga" readonly>
                                @error('total_harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Studio and Seat Selection -->
                        <h6>Pilih Kursi:</h6>
                        <div class="mb-3">
                            @foreach ($details->studio->kursi as $kursi)
                                <div class="kursi-item" title="Kursi {{ $kursi->nomor }}" data-id="{{ $kursi->id }}">
                                    <input type="checkbox" name="kursis[]" value="{{ $kursi->id }}">
                                    {{ $kursi->nomor }}
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaPerKursi = {{ $detail->harga }};

            function updateTotalHarga() {
                const selectedSeats = document.querySelectorAll('.kursi-item.selected').length;
                const totalHarga = selectedSeats * hargaPerKursi;
                document.getElementById('jumlah_tiket_input').value = selectedSeats;
                document.getElementById('total_harga_input').value = totalHarga;
            }

            document.querySelectorAll('.kursi-item').forEach(item => {
                if (!item.classList.contains('reserved')) {
                    item.addEventListener('click', function() {
                        const checkbox = this.querySelector('input[type="checkbox"]');
                        checkbox.checked = !checkbox.checked;
                        this.classList.toggle('selected', checkbox.checked);
                        updateTotalHarga();
                    });
                }
            });
        });
    </script>
@endsection
