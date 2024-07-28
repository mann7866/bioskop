@extends('layouts.app')

@section('content')

@if (session('gagal'))
<div class="toast-container position-fixed top-5 end-0 p-3" style="z-index: 11">
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
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
    </style>
</head>
<body>

    <div class="container">
        <h2>Halaman Pembayaran</h2>
        <form action="{{ route('order.update', $order->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="jumlah_tiket">Total Tiket:</label>
                <input type="jumlah_tiket" name="jumlah_tiket"  value="{{ $order->jumlah_tiket }}">
            </div>
            <div class="form-group">
                <label for="total_harga">Total Bayar:</label>
                <input type="total_harga"  name="total_harga" value="{{ $order->total_harga }}">
            </div>
            <div class="form-group">
                <label for="pembayaran">Bayar: </label>
                <input type="pembayaran" id="pembayaran" name="pembayaran" required>
            </div>
            <button type="submit" class="btn-submit">Bayar</button>
        </form>
    </div>

</body>
</html>


@endsection
