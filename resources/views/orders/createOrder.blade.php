@extends('layouts.app')

<style>
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

</style>

@section('content')
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
                        <div class="container">
                            <h2 class="form-title">Pilih Studio</h2>
                            {{--  <div class="film-container">
                                @foreach ($kursi as $studioId => $kursis)
                                    <div class="film-card text-center" data-bs-toggle="modal"
                                        data-bs-target="#filmModal{{ $studioId }}">
                                        <label class="film-label">{{ $kursis->first()->studio->studio }}</label>
                                    </div>
                                @endforeach
                            </div>  --}}
                            <div class="mb-3">
                                <label for="studio" class="form-label">Pilih Studio</label>
                                <div class="studio-container">
                                    @foreach ($kursi as $studioId => $kursis)
                                        <div class="form-check studio-card" class="film-card text-center" data-bs-toggle="modal"
                                        data-bs-target="#filmModal{{ $studioId }}">
                                            <input class="form-check-input" type="radio" id="studio{{ $studioId }}" name="id_studios" value="{{ $studioId }}">
                                            <label class="form-check-label" for="studio{{ $studioId }}">
                                                {{ $kursis->first()->studio->studio }}
                                            </label>
                                            @error('id_studios')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>



                            <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">Order</button>
                        </div>

                        @foreach ($kursi as $studioId => $kursis)
                            <!-- Film Modal -->
                            <div class="modal fade" id="filmModal{{ $studioId }}" tabindex="-1"
                                aria-labelledby="filmModalLabel{{ $studioId }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="filmModalLabel{{ $studioId }}">Pilih Kursi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($kursis->chunk(10) as $chunk)
                                            <div class="kursi-row">
                                                @foreach ($chunk as $item)
                                                <div class="kursi-item"
                                                    data-seat-id="{{ $item->id }}"
                                                    data-seat-number="{{ $item->kursi }}">
                                                   <input class="form-check-input @error('kursis') is-invalid @enderror" type="checkbox" name="kursis[]" value="{{ $item->id }}">
                                                   <strong>{{ $item->kursi }}</strong>
                                               </div>
                                                @endforeach
                                            </div>
                                        @endforeach

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                if (!item.classList.contains('reserved')) { // Hanya tambahkan event listener untuk kursi yang belum dipesan
                    item.addEventListener('click', function() {
                        const checkbox = item.querySelector('input[type="checkbox"]');
                        checkbox.checked = !checkbox.checked; // Toggle checkbox status
                        item.classList.toggle('selected');
                        updateTotalHarga();
                    });
                }
            });
        });

    </script>

    <style>

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

       /* Sembunyikan checkbox tetapi tetap bisa diakses secara programatik */
.kursi-item input[type="checkbox"] {
    display: none;
}

.kursi-item {
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


        .kursi-row {
            margin-bottom: 10px;
        }

        /* Adjust the size of the modal content to fit better */
        .modal-dialog {
            max-width: 80%;
        }
    </style>
@endsection
