@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
<style>
    .warning{
        background-color: blue;
        transition: 2s ease;
    }
    .warning:hover{
        border-radius: 25px 27px ;
    }
</style>
<div>
    <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('lokasi.create') }}">
        <i class="fas fa-plus"></i> Tambah lokasi
    </a>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h4 class="card-title text-center"><i class="fas fa-film"></i> Daftar lokasi</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="lokasiTable" width="100%" cellspacing="0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Studio</th>
                        <th class="text-center">kursi</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lokasi as $item)
                        <tr>
                            <td class="text-center">{{ $item->studio }}</td>
                            <td class="text-center">{{ $item->kursi }}</td>
                            <td class="text-center">
                                <a href="{{ route('lokasi.edit', $item->id) }}" class="btn btn-success btn-sm">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>
                                <a href="{{ route('lokasi.delete', $item->id) }}">
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
    <script>
        $(document).ready(function() {
            $('#lokasiTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush