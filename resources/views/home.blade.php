@extends('layouts.app')

@section('content')
<style>
    .film-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        width: calc(33.333% - 10px); /* Adjust the width to fit three items per row with some margin */
        margin: 5px;
    }

    .film-card img {
        width: 100%;
        height: 400px; /* Fixed height for uniformity */
        object-fit: cover; /* Ensures the image covers the entire area without stretching */
        transition: transform 0.3s ease;
    }

    .film-card:hover img {
        transform: scale(1.1);
    }

    .film-description {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
        text-align: center;
    }

    .film-card:hover .film-description {
        opacity: 1;
    }

    .film-label {
        display: block;
        text-align: center;
        margin-top: 10px;
    }

    .film-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center mb-4">
                <div class="card-header">{{ __('Bioskop Amerika') }}</div>
                <div class="card-body">
                    <p>{{ __('Welcome to Bioskop Amerika! Enjoy the latest movies.') }}</p>
                </div>
            </div>
            <div class="film-container">
                <div class="mb-4 film-card">
                    <img src="{{ asset('image/us-1.jpg') }}" class="img-fluid" alt="Film 1">
                    <div class="film-description">
                        <h5>Sou Sou No Frieren</h5>
                        <p>Sang Elf yang telah Mengalahkan Raja Iblis</p>
                    </div>
                    <label class="film-label">Sou Sou No Frieren</label>
                </div>
                <div class="mb-4 film-card">
                    <img src="{{asset('image/us-3.jpg')}}" class="img-fluid" alt="Film 2">
                    <div class="film-description">
                        <h5>Demon Slayer</h5>
                        <p>Bercerita tentang seorang kaka yang Mencari Obat untuk Adik Ya</p>
                    </div>
                    <label class="film-label">Film 2</label>
                </div>
                <div class="mb-4 film-card">
                    <img src="{{ asset('image/us-2.jpg') }}" class="img-fluid" alt="Film 3">
                    <div class="film-description">
                        <h5>Oshi No Ko</h5>
                        <p>Mengorbanan Sang Ibu Yang Di bunuh Fans</p>
                    </div>
                    <label class="film-label">Film 3</label>
                </div>
                <div class="mb-4 film-card">
                    <img src="{{ asset('image/us-3.jpg') }}" class="img-fluid" alt="Film 4">
                    <div class="film-description">
                        <h5>Demon Slayer Art</h5>
                        <p>Peperangan Antara Iblis tingkat atas</p>
                    </div>
                    <label class="film-label">Film 4</label>
                </div>
                <div class="mb-4 film-card">
                    <img src="{{ asset('image/us-4.jpeg') }}" class="img-fluid" alt="Film 5">
                    <div class="film-description">
                        <h5>Film 5</h5>
                        <p>Deskripsi singkat film 5.</p>
                    </div>
                    <label class="film-label">Film 5</label>
                </div>
                <div class="mb-4 film-card">
                    <img src="{{ asset('image/us-5.jpeg') }}" class="img-fluid" alt="Film 6">
                    <div class="film-description">
                        <h5>Film 6</h5>
                        <p>Deskripsi singkat film 6.</p>
                    </div>
                    <label class="film-label">Film 6</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
