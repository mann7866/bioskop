@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
<style>
    .warning {
        background-color: #007bff; /* Warna biru dari Bootstrap */
        transition: 0.3s ease;
    }
    .warning:hover {
        border-radius: 25px 27px;
        background-color: #0056b3; /* Warna biru gelap saat hover */
    }
    .table-responsive {
        max-width: 100%;
        overflow-x: auto;
    }
    #genreTable {
        max-width: 1165px; /* Atur lebar maksimum tabel */
        margin: auto; /* Centering tabel */
    }
    th, td {
        white-space: nowrap; /* Mencegah teks melampaui batas kolom */
    }
    .card-header {
        background-color: #f8f9fa; /* Warna latar belakang header */
        border-bottom: 1px solid #dee2e6; /* Garis bawah header */
    }
    .card-title {
        font-size: 1.5rem; /* Ukuran font judul card */
        color: #343a40; /* Warna font judul card */
    }
    .btn-success, .btn-danger {
        font-size: 0.875rem; /* Ukuran font tombol */
    }
</style>
<div>
    <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('genres.create') }}">
        <i class="fas fa-plus"></i> Tambah Genre
    </a>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h4 class="card-title text-center"><i class="fas fa-film"></i> Daftar Genre</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="genreTable" cellspacing="0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Judul Film</th>
                        <th class="text-center">Genre Film</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $item)
                        <tr>
                            <td class="text-center">{{ $item->id_judul }}</td>
                            <td class="text-center">{{ $item->id_genre }}</td>
                            <td class="text-center">
                                <a href="{{ route('genres.edit', $item->id) }}" class="btn btn-success btn-sm">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>
                                <a href="{{ route('genres.delete', $item->id) }}">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
