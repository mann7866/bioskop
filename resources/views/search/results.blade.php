@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Pencarian</h1>
    @if($films->isEmpty())
        <p>Tidak ada hasil yang ditemukan untuk pencarian "{{ $query }}".</p>
    @else
        <ul>
            @foreach($films as $film)
                <li>
                    <img src="{{ asset('image/' . $film->gambar) }}" class="img-fluid" alt="{{ $film->judul }}" data-bs-toggle="modal" data-bs-target="#filmModal{{ $film->id }}">
                    <p>{{ $film->judul }}</p>
                    <!-- Debug: Tampilkan Jalur Gambar -->
                    <p>Path: {{ asset('image/' . $film->gambar) }}</p>
                </li>

                <!-- Modal -->
                <div class="modal fade" id="filmModal{{ $film->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $film->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('image/' . $film->gambar) }}" class="img-fluid mb-3" alt="{{ $film->judul }}">
                                <p>{{ $film->deskripsi }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    @endif
</div>
@endsection
