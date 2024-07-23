@extends('layouts.app')

@section('content')
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
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
            transition: transform 0.2s, background-color 0.2s;
            position: relative;
        }

        .seat.selected {
            background-color: green;
            transform: scale(1.2);
        }

        .seat.reserved {
            background-color: red;
            cursor: not-allowed;
        }

        .seat:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
        }

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
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            .btn-submit {
                margin-top: 15px;
            }
        }

        .Class {
            list-style: none;
        }

        .total-container {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>

    <form action="{{ route('order.store', $detail->id) }}" method="POST">
        @csrf

        <div class="container mt-4">
            <div class="form-container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img id="imagePreview" src="{{ asset('image/' . $detail->foto) }}" class="card-img-top"
                                alt="{{ $detail->judul }}">
                            <div class="card-body">
                                <p> <strong>Genres:</strong> </p>
                                <ul>
                                    @foreach ($detail->genres as $genre)
                                        <li class="Class">{{ $genre->genre }}</li>
                                    @endforeach
                                </ul>
                                <h5 class="card-title">{{ $detail->judul }}</h5>
                                <p class="card-text">{{ $detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                                <label for="judul" class="form-label">Judul film :</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $detail->judul }}" disabled>
                                <input type="hidden" name="judul" value="{{ $detail->judul }}">
                            </div>

                            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                                <label for="total" class="form-label" style="width: 100px;">Total Harga </label>
                                <input type="text" class="form-control" id="total" value="Rp. 0" disabled>
                                <input type="hidden" name="total_harga" id="hiddenTotalHarga" value="0">
                            </div>

                            <div class="col-md-4" style="margin-top: 30px; margin-bottom:20px;">
                                <label for="jumlahTiket" class="form-label">Jumlah Tiket :</label>
                                <input type="text" class="form-control" id="jumlahTiket" value="0" disabled>
                                <input type="hidden" name="jumlahTiket" id="hiddenJumlahTiket" value="0">
                            </div>
                        </div>

                        <div class="container">
                            <h2>Pilih Kursi</h2>
                            <div class="seats">
                                <!-- Generate seats dynamically -->
                            </div>
                            <div class="total-container">
                                Total kursi yang dipilih: <span id="totalKursi">0</span>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-submit" type="submit" name="submit">Order</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const seatsContainer = document.querySelector('.seats');
                const totalKursiElement = document.getElementById('totalKursi');
                const jumlahTiketInput = document.getElementById('jumlahTiket');
                const totalHargaElement = document.getElementById('total');
                let totalKursiDipilih = 0;
                const hargaPerKursi = {{ $detail->harga }};

                // Jumlah kursi yang akan ditampilkan
                const jumlahKursi = 30;

                // Generate seats dynamically
                for (let i = 1; i <= jumlahKursi; i++) {
                    const seat = document.createElement('div');
                    seat.className = 'seat';
                    seat.textContent = i;
                    seat.setAttribute('data-tooltip', `Kursi No: ${i}`);
                    seatsContainer.appendChild(seat);

                    // Handle seat click
                    seat.addEventListener('click', function() {
                        if (!seat.classList.contains('reserved')) {
                            seat.classList.toggle('selected');
                            updateTotalKursi();
                            updateJumlahTiket();
                            updateTotalHarga();
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
                    document.getElementById('hiddenJumlahTiket').value = totalKursiDipilih;
                }

                // Function untuk mengupdate total harga berdasarkan jumlah kursi yang dipilih
                function updateTotalHarga() {
                    const totalHarga = totalKursiDipilih * hargaPerKursi;
                    totalHargaElement.value = `Rp. ${totalHarga.toLocaleString()}`;
                    document.getElementById('hiddenTotalHarga').value = totalHarga;
                }
            });
            // btn btn-submit
            $(document).ready(function() {
                $('.btn-submit').hover(
                    function() { // Mouse enter
                        $(this).data('Order', $(this).text());
                        $(this).text('Buy');
                    },
                    function() { // Mouse leave
                        $(this).text($(this).data('Order'));
                    }
                );
            });
        </script>

    </form>
@endsection
