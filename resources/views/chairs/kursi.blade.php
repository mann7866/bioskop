@extends('layouts.app')

@section('search')
    <form action="{{ route('detail') }}" method="GET" class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film" aria-label="Search" required>
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

                <a href="{{ route('kursi.create') }}" class="btn btn-primary mb-4">Tambah Kursi</a>

                <div class="film-container">
                    @php
                        $studios = $kursi->groupBy('studio');
                    @endphp
                    @foreach ($studios as $studio => $kursiStudio)
                        <div class="film-card" data-bs-toggle="modal" data-bs-target="#filmModal{{ str_replace(' ', '', $studio) }}">
                            {{ $studio }}
                        </div>
                    @endforeach
                </div>

                @foreach ($studios as $studio => $kursiStudio)
                    <!-- Film Modal -->
                    <div class="modal fade" id="filmModal{{ str_replace(' ', '', $studio) }}" tabindex="-1"
                        aria-labelledby="filmModalLabel{{ str_replace(' ', '', $studio) }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filmModalLabel{{ str_replace(' ', '', $studio) }}">Detail Studio {{ $studio }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="kursi-container">
                                        @foreach ($kursiStudio as $kursi)
                                            <div class="kursi-card">
                                                {{ $kursi->kursi }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kursi.edit', $kursiStudio->first()->id) }}" class="btn btn-primary">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $kursiStudio->first()->id }}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal{{ $kursiStudio->first()->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $kursiStudio->first()->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $kursiStudio->first()->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('kursi.delete', $kursiStudio->first()->id) }}" method="GET">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
