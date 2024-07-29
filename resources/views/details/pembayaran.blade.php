@extends('layouts.app')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-submit {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #45a049;
    }

    .result {
        margin-top: 20px;
        font-size: 1.2em;
        color: green;
    }
</style>
@section('content')
    @if (session('gagal'))
        <div class="toast-container position-fixed top-2 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('gagal') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="toast-container position-fixed top-5 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center text-bg-success border-0 show slide-down" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <h2>Halaman Pembayaran</h2>
        <form action="{{ route('order.update', $order->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="jumlah_tiket">Total Tiket:</label>
                <input type="number" name="jumlah_tiket" value="{{ $order->jumlah_tiket }}" readonly>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Bayar:</label>
                <input type="number" name="total_harga" value="{{ $order->total_harga }}" readonly>
            </div>
            <div class="form-group">
                <label for="pembayaran">Bayar: </label>
                <input type="number" id="pembayaran" name="pembayaran" required oninput="calculateChange()">
            </div>
            <div class="form-group">
                <label for="kembalian_display">Kembalian: </label>
                <input type="text" id="kembalian_display" name="kembalian_display" placeholder="0o" readonly>
            </div>
            <input type="hidden" id="hidden_kembalian" name="kembalian">
            <button type="submit" class="btn-submit">Bayar</button>
        </form>
    </div>

    <script>
        function formatRupiah(angka) {
            return "Rp. " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function calculateChange() {
            var totalBayar = parseFloat(document.querySelector('input[name="total_harga"]').value);
            var pembayaran = parseFloat(document.getElementById('pembayaran').value);
            var kembalian = pembayaran - totalBayar;

            if (pembayaran > 0) {
                if (kembalian >= 0) {
                    document.getElementById('kembalian_display').value = formatRupiah(kembalian);
                    document.getElementById('hidden_kembalian').value = kembalian;
                } else {
                    document.getElementById('kembalian_display').value = "Rp. 0";
                    document.getElementById('hidden_kembalian').value = 0;
                }
            } else {
                document.getElementById('kembalian_display').value = "";
                document.getElementById('hidden_kembalian').value = 0;
            }
        }
    </script>
@endsection
