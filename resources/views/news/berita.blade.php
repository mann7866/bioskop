@extends('layouts.app')

@section('content')

<style>
    .news-container {
            margin-top: 20px;
        }

        .news-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin: 10px;
            flex: 0 0 calc(33.33% - 20px);
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 10px 10px 0 0;
        }

        .news-card:hover img {
            transform: scale(1.05);
        }

        .news-body {
            padding: 15px;
        }

        .news-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .news-text {
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
        }

        .news-time {
            font-size: 0.85rem;
            color: #888;
        }

        @media (max-width: 768px) {
            .news-card {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .news-card {
                flex: 0 0 calc(100% - 20px);
            }
        }

        .film-label-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }
</style>

<div class="news-container">
    <h2>Berita</h2>
    <a href="{{ route('berita.create') }}">
        <button type="button" class="btn-create">
          tambah
        </button>
    </a>
    <div class="row">
             @foreach ($berita as $item)

        <div class="news-card col-md-4">
            <img src="{{ asset('imageBerita/' . $item->foto_deskripsi) }}" class="img-fluid" alt="{{ $item->judul }}">
            <div class="news-body">
                <h5 class="news-title">{{ $item->judul }}</h5>
                <p class="news-text">{{ $item->deskripsi }}</p>
                <p class="news-time">Tanggal Tayang: {{ $item->tanggal }}</p>
            </div>

            <div class="film-label-container">
               <a href="{{ route('berita.edit', $item->id) }}">
                <button type="button" class="btn-edit">
                    <ion-icon name="create-outline"></ion-icon>
                </button>
               </a>

               <a href="{{ route('berita.delete', $item->id) }}">
                <button type="button" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                    <ion-icon name="trash-outline"></ion-icon>
                </button>
            </a>
            </div>
        </div>

        @endforeach
    </div>

@endsection
