@extends('layouts.app')

@section('content')
<style>
    <style>
    /* Styling umum untuk form */
    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
    }

    .form-title {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card img {
        border-bottom: 2px solid #ddd;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
    }

    .card-text {
        color: #555;
    }

    .seats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }

    .seat {
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
        position: relative;
    }

    .seat:hover {
        transform: scale(1.1);
    }

    .seat::after {
        content: attr(data-seat);
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 2px 5px;
        border-radius: 4px;
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .seat:hover::after {
        opacity: 1;
    }

    .seat.selected {
        background-color: #4caf50;
        color: white;
    }

    .seat.reserved {
        background-color: #f44336 ;
        cursor: not-allowed;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .form-label {
        font-weight: bold;
    }

    .total-seats {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }
</style>

</style>
    <div class="container mt-4">
        <div class="form-container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('image/' . $detail->foto) }}" class="img-fluid" alt="{{ $detail->judul }}">
                        <div class="card-body">
                            <h2>Genres:</h2>
                            <ul>
                                @foreach ($detail->genres as $genre)
                                    <li>{{ $genre->genre }}</li>
                                @endforeach
                            </ul>
                            <h5 class="card-title">{{ $detail->judul }}</h5>
                            <h6 class="">Rp. {{ number_format($detail->harga) }}</h6>
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
                                <input type="text" class="form-control @error('jumlah_tiket') is-invalid @enderror" id="jumlah_tiket_input" name="jumlah_tiket" >
                                @error('jumlah_tiket')
                                    <d                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      iv class="invalid-feedback">{{ $message }}</d>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga_input" name="total_harga" >
                                @error('total_harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="container">
                            <h2 class="form-title">Pilih Kursi</h2>
                            <div class="seats" id="seatsContainer">
                                <!-- Kursi akan ditampilkan di sini -->
                            </div>
                            <div class="total-seats">
                                Total kursi yang dipilih: <span id="totalKursi">0</span>
                            </div>
                        </div>

                        <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seatsContainer = document.getElementById('seatsContainer');
            const totalKursiElement = document.getElementById('totalKursi');
            const jumlahTiketInput = document.getElementById('jumlah_tiket_input');
            const totalHargaInput = document.getElementById('total_harga_input');
            let totalKursiDipilih = 0;
            const hargaPerKursi = {{ $detail->harga }}; // Ambil harga per kursi dari PHP

            // Jumlah kursi yang akan ditampilkan
            const jumlahKursi = 30;

            // Generate seats dynamically
            for (let i = 1; i <= jumlahKursi; i++) {
                const seat = document.createElement('div');
                seat.className = 'seat';
                seat.textContent = i;
                seat.setAttribute('data-seat', i); // Set data-seat attribute
                seatsContainer.appendChild(seat);

                // Handle seat click
                seat.addEventListener('click', function() {
                    if (!seat.classList.contains('reserved')) {
                        seat.classList.toggle('selected');
                        updateTotalKursi();
                        updateJumlahTiket();
                        updateTotalHarga(); // Panggil fungsi updateTotalHarga setiap kali kursi dipilih
                    }
                });
            }

            // Function untuk mengupdate total kursi yang dipilih
            function updateTotalKursi() {
                const selectedSeats = document.querySelectorAll('.seat.selected');
                totalKursiDipilih = selectedSeats.length;
                totalKursiElement.textContent = totalKursiDipilih;
            }

            // Function untuk mengupdate jumlah tiket berdasarkan kursi yang dipilih
            function updateJumlahTiket() {
                jumlahTiketInput.value = totalKursiDipilih;
            }

            // Function untuk mengupdate total harga berdasarkan kursi yang dipilih
            function updateTotalHarga() {
                const selectedSeats = document.querySelectorAll('.seat.selected');
                const totalHarga = hargaPerKursi * selectedSeats.length;
                totalHargaInput.value = totalHarga;
            }
        });
    </script>
@endsection
