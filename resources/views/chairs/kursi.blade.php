@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search"
            required>
        <a class="btn btn-outline-primary" href="{{ route('detail') }}">Refresh</a>
    </form>
@endsection

<link rel="stylesheet" href="{{ asset('css/kursi.css') }}">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center text-secondary">Kursi Film</h1>

                <a href="{{ route('kursi.create') }}" class="btn btn-primary btn-create">Tambah Kursi</a>

                <div class="film-container">
                    @foreach ($kursi as $studioId => $kursis)
                        <div class="film-card text-center" data-bs-toggle="modal"
                            data-bs-target="#filmModal{{ $studioId }}">
                            <label class="film-label">{{ $kursis->first()->studio->studio }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @foreach ($kursi as $studioId => $kursis)
            <!-- Film Modal -->
            <div class="modal fade" id="filmModal{{ $studioId }}" tabindex="-1"
                aria-labelledby="filmModalLabel{{ $studioId }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filmModalLabel{{ $studioId }}">Detail Film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($kursis->chunk(10) as $chunk)
                                <div class="kursi-row">
                                    @foreach ($chunk as $item)
                                        <div class="kursi-item">
                                            <strong>{{ $item->kursi }}</strong>
                                            <div class="button-group">
                                                <button class="btn btn-sm btn-edit">
                                                    <a href="{{ route('kursi.edit', $item->id) }}"><i
                                                            class="bi bi-pen"></i></a>
                                                </button>
                                                <button class="btn btn-sm btn-delete">
                                                    <a href="{{ route('kursi.delete', $item->id) }}"><i
                                                            class="bi bi-backspace-reverse"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $studioId }}">Hapus Studio</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
