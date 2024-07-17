@extends('layouts.app')

@section('content')
<style>
    .film-card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        width: calc(33.333% - 10px); /* Adjust the width to fit three items per row with some margin */
        margin: 5px;
        cursor: pointer; /* Add pointer cursor for clickable effect */
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
    .poss{
        position: static;
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
                {{-- Film 1 --}}
                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film1Modal">
                    <img src="{{ asset('image/us-1.jpg') }}" class="img-fluid" alt="Film 1">
                    <div class="film-description">
                        <h5 class="poss">Sou Sou No Frieren</h5>
                        <p>Sang Elf yang telah Mengalahkan Raja Iblis</p>
                    </div>
                    <label class="film-label">Sou Sou No Frieren</label>
                </div>
                {{-- Film 2 --}}
                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film2Modal">
                    <img src="{{asset('image/us-3.jpg')}}" class="img-fluid" alt="Film 2">
                    <div class="film-description">
                        <h5>Demon Slayer</h5>
                        <p>Bercerita tentang seorang kaka yang Mencari Obat untuk Adik Ya</p>
                    </div>
                    <label class="film-label">Film 2</label>
                </div>
                {{-- Film 3 --}}
                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film3Modal">
                    <img src="{{ asset('image/us-2.jpg') }}" class="img-fluid" alt="Film 3">
                    <div class="film-description">
                        <h5>Oshi No Ko</h5>
                        <p>Mengorbanan Sang Ibu Yang Di bunuh Fans</p>
                    </div>
                    <label class="film-label">Film 3</label>
                </div>
                {{-- Film 4 --}}
                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film4Modal">
                    <img src="{{ asset('image/us-3.jpg') }}" class="img-fluid" alt="Film 4">
                    <div class="film-description">
                        <h5>Demon Slayer Art</h5>
                        <p>Peperangan Antara Iblis tingkat atas</p>
                    </div>
                    <label class="film-label">Film 4</label>
                </div>
                {{-- Film 5 --}}
                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film5Modal">
                    <img src="{{ asset('image/us-4.jpeg') }}" class="img-fluid" alt="Film 5">
                    <div class="film-description">
                        <h5>Film 5</h5>
                        <p>Deskripsi singkat film 5.</p>
                    </div>
                    <label class="film-label">Film 5</label>
                </div>
                {{-- Film 6 --}}
                <div class="mb-4 film-card" data-bs-toggle="modal" data-bs-target="#film6Modal">
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

{{-- Bootstrap Modals --}}
<div class="modal fade" id="film1Modal" tabindex="-1" aria-labelledby="film1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="film1ModalLabel">Sou Sou No Frieren</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/samplevideo1" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="film2Modal" tabindex="-1" aria-labelledby="film2ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="film2ModalLabel">Demon Slayer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/samplevideo2" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="film3Modal" tabindex="-1" aria-labelledby="film3ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="film3ModalLabel">Oshi No Ko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/samplevideo3" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="film4Modal" tabindex="-1" aria-labelledby="film4ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="film4ModalLabel">Demon Slayer Art</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/samplevideo4" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="film5Modal" tabindex="-1" aria-labelledby="film5ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="film5ModalLabel">Film 5</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/samplevideo5" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="film6Modal" tabindex="-1" aria-labelledby="film6ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="film6ModalLabel">Film 6</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/samplevideo6" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
