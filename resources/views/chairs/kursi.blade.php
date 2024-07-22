@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif
<style>
    .warning{
        position:relative;
        background-color: blue;
        transition: 2s ease;
        overflow:hidden;
    }
    .warning::after{
        content: '';
        position:absolute;
        left:50%;                         
        bottom:0;
        width:0;
        height: 2px;
        background-color:red;
        transition:all 0.4s;
    }
    .warning:hover::after{
        left: 0;
        width: 100%;
    }
</style>
<div>
    <a class="btn btn-primary mt-5 m-2 warning" href="{{ route('kursi.create') }}">
        <i class="fas fa-plus"></i> Tambah kursi
    </a>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h4 class="card-title text-center"><i class="fas fa-film"></i> Daftar kursi</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="kursiTable" width="100%" cellspacing="0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">kursi</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kursi as $item)
                        <tr>

                            <td class="text-center">{{ $item->kursi }}</td>
                            <td class="text-center">
                                {{--  <a href="{{ route('kursi.edit', $item->id) }}" class="btn btn-success btn-sm">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>  --}}
                                <a href="{{ route('kursi.delete', $item->id) }}">
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
            $('#kursiTable').DataTable({
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