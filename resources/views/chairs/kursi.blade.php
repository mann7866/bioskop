@extends('layouts.app')

@section('content')
    <style>
        * {
            scroll-behavior: smooth;
            font-family: Arial, sans-serif;
        }

        .seat-container {  
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .seat-card {
            background-color: #3498db;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            flex: 0 0  100px;
            /* Adjust this value for different seat widths */
        }

        .seat-card:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 2s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateZ(-9.7rem);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fade-out {
            animation: fade-out 1s ease forwards;
        }

        @keyframes fade-out {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>

    @if (session('success'))
        <div class="toast-container position-fixed top-5 end-0 p-2">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <h1 class="text-center text-secondary small">Daftar Kursi</h1>
        <a href="{{ route('kursi.create') }}" class="btn btn-primary mb-4 rounded">Tambah Kursi</a>
        <div class="seat-container">
            @foreach ($kursi as $seat)
                <div class="seat-card">
                    {{ $seat->kursi }}
                </div>
            @endforeach
        </div>
        <a href="{{ route('home') }}" class="btn btn-secondary btn-back mt-4">Back to Home</a>
    </div>
@endsection
