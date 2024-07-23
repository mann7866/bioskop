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

        .seats {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .seat {
            width: 40px;
            height: 40px;
            background-color: lightblue;
            margin: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 5px;
        }

        .seat.selected {
            background-color: green;
        }

        .seat.reserved {
            background-color: red;
            cursor: not-allowed;
        }
    </style>

    <div class="container mt-4">
        <div class="form-container">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <img src="{{ asset('image/' . $detail->foto) }}" class="img-fluid text-center" alt="{{ $detail->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $detail->judul }}</h5>
                            <h6 class="">Rp. {{ number_format($detail->harga) }}</h6>
                            <p class="card-text">{{ $detail->deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                        @csrf

                        <input type="hidden" name="id_detail" value="{{ $detail->id }}">
                        <input type="hidden" name="harga" value="{{ $detail->harga }}">
                        <input type="hidden" name="jumlah_tiket" id="jumlah_tiket" value="0">
                        <input type="hidden" name="total_harga" id="total_harga" value="0">

                        <div class="mb-3">
                            <div class="col-md-6">
                                <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                                <input type="text" class="form-control @error('jumlah_tiket') is-invalid @enderror" id="jumlah_tiket_input" name="jumlah_tiket_input" >
                                @error('jumlah_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga_input" name="total_harga_input" >
                                @error('total_harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="container">
                            <h2>Pilih Kursi</h2>
                            <div class="seats" id="seatsContainer">
                                <!-- Kursi akan ditampilkan di sini -->
                            </div>
                            <div>
                                <p>Total kursi yang dipilih: <span id="totalKursi">0</span></p>
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

            // Function untuk mengupdate total harga berdasarkan kursi yang dipilih
            function updateTotalHarga() {
                const selectedSeats = document.querySelectorAll('.seat.selected');
                const totalHarga = hargaPerKursi * selectedSeats.length;
                totalHargaInput.value = totalHarga;
            }
        });
    </script>
@endsection
