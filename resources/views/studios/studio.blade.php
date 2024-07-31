@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search"
            required>
        <a class="btn btn-outline-primary" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection

@section('content')
    <style>
        .film-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            border-radius: 10px;
            width: 150px;
            height: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .film-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
        }

        .kursi-card {
            width: 50px;
            height: 50px;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            margin: 5px;
        }

        .kursi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Kursi Film</h1>

                <a href="{{ route('studio.create') }}" class="btn btn-primary mb-4">Tambah Studio</a>

                                @forelse ($studio as $item)

               <div>
                <p>{{ $item->studio }}</p>
               </div>
                @empty
                <p>tidak ada studio</p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
