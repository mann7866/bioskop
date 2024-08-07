@extends('layouts.app')

@section('content')
    <style>
        .kursi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .kursi-card {
            background-color: #3498db; /* Biru cerah */
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            width: 120px; /* Lebar kartu */
        }

        .kursi-card:hover {
            background-color: #2980b9; /* Biru lebih gelap */
            transform: scale(1.05);
        }

        .kursi-card a {
            color: white;
            text-decoration: none;
        }

        .kursi-card a:hover {
            text-decoration: underline;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>

    <div class="container">
        <h1 class="text-center text-secondary">Daftar Kursi Bioskop</h1>

<a href="{{ route('kursi.create') }}" class="btn btn-primary mb-4 warning">Tambah Kursi</a>

        <div class="kursi-container">
            @foreach ($kursi as $seat)
                <div class="kursi-card">

                        Kursi {{ $seat->label }}

                </div>
            @endforeach
        </div>
        <a href="{{ route('home') }}" class="btn btn-secondary btn-back">Kembali ke Beranda</a>
    </div>
@endsection
