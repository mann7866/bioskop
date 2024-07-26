@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-secondary text-center">Hasil Pencarian</h1>
        @if ($films->isEmpty())
        @include('errors.notfound')
        @else
        {{-- Debugging Data --}}
        {{-- <pre>{{ print_r($films->toArray(), true) }}</pre>
        <pre>{{ print_r($query, true) }}</pre> --}}

            <div class="row">
                @foreach ($films as $film)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ asset('image/' . $film->foto) }}" class="card-img-top img-fluid"
                                alt="{{ $film->judul }}" data-bs-toggle="modal"
                                data-bs-target="#filmModal{{ $film->id }}">
                            <div class="card-body">
                                <h5 class="card-title">Judul: {{ $film->judul }}</h5>
                                <p class="card-text">Deskripsi: {{ \Illuminate\Support\Str::limit($film->deskripsi, 100) }}</p>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="filmModal{{ $film->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $film->judul }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('image/' . $film->foto) }}" class="img-fluid mb-3"
                                        alt="{{ $film->judul }}">
                                        <h5 class="card-title">Judul: {{ $film->judul }}</h5>
                                        <p>Deskripsi:{{ $film->deskripsi }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <a href="{{route('home')}}" class="btn btn-outline-danger m-3">Back</a>

    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @endpush
@endsection
