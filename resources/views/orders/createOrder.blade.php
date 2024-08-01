@extends('layouts.app')

@section('content')
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
            background-color: #f44336;
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
    <div class="container mt-4">
        <div class="form-container">
            <div class="row">
                <div class="col-md-4">
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
                            <h6>Harga Tiket Film :</h6>
                            <h6 class="card-">Rp. {{ number_format($detail->harga) }}</h6>
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
                                <input type="text" class="form-control @error('jumlah_tiket') is-invalid @enderror" id="jumlah_tiket_input" name="jumlah_tiket">
                                @error('jumlah_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga_input" name="total_harga">
                                @error('total_harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="container">
                            <h2 class="form-title">Pilih Studio</h2>
                            {{--  <div class="form-group">
                                <select class="form-control" id="studioSelect" onchange="handleStudioChange(this)">
                                    <option value="">Pilih Studio</option>
                                    @foreach($studio as $index => $namaStudio)
                                        <option value="{{ $index }}">{{ $namaStudio }}</option>
                                    @endforeach
                                </select>
                            </div>  --}}
                            @foreach ($studio as $index => $namaStudio)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $index }}" name="id_studios" id="id_studios" id="flexCheckDefault" onchange="handleStudioChange(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                 {{ $namaStudio }}
                                </label>
                            </div>
                            @endforeach

                            <div>Jumlah Kursi: <span id="kursiCount"></span></div>
                            <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">Order</button>
                        </div>
                        <!-- Modal Kursi -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="form-title">Pilih Kursi</h2>
                                        <div class="seats" id="seatsContainer">
                                            <!-- Kursi akan ditampilkan di sini -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function handleStudioChange(select) {
                                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                                myModal.show();
                            }
                        </script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const kursi = @json($kursi);
                                const hargaPerKursi = {{ $detail->harga }};
                                const jumlahKursi = kursi.length;
                                document.getElementById('kursiCount').innerText = jumlahKursi;
                                const seatsContainer = document.getElementById('seatsContainer');
                                kursi.forEach((nominal, index) => {
                                    const seat = document.createElement('div');
                                    seat.className = 'seat available';
                                    seat.textContent = nominal;
                                    seat.setAttribute('data-seat', index + 1);
                                    seatsContainer.appendChild(seat);
                                    seat.addEventListener('click', function() {
                                        seat.classList.toggle('selected');
                                        updateTotalHarga();
                                    });
                                });
                                function updateTotalHarga() {
                                    const selectedSeats = document.querySelectorAll('.seat.selected').length;
                                    const totalHarga = selectedSeats * hargaPerKursi;
                                    document.getElementById('jumlah_tiket_input').value = selectedSeats;
                                    document.getElementById('total_harga_input').value = totalHarga;
                                }
                            });
                        </script>
                    @endsection
