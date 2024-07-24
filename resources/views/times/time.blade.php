@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-3 pos">
            {{ session('success') }}
        </div>
    @endif

    <style>
        .pos {
            text-align: center;
            max-width: 300px;
            margin: 0 auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1)
        }
        .warning {
            background-color: aqua;
            color: white;
            transition: 2s ease;
            position: relative;
            overflow: hidden;
        }
        /* .warning:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        } */
        .warning::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: royalblue;
        transition: all 0.3s;
    }
        .warning:hover::after {
        background-color: red;
        left: 0;
        width: 100%;
    }
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <a class="btn btn-outline-primary warning" href="{{ route('time.create') }}">
                <i class="fas fa-plus"></i> Tambah Time
            </a>
        </div>
        <div class="card text-center mt-4">
            <div class="card-header">
                <h3>{{ __('Daftar Tayang') }}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-center">Jam Tayang</th>
                                <th class="text-center">Tanggal Tayang</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($time as $item)
                                <tr>
                                    <td class="text-center">{{ date('H:i', strtotime($item->jamTayang)) }}</td>
                                    <td class="text-center">{{ $item->tanggalTayang }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('time.edit', $item->id) }}" class="btn btn-success">
                                            <ion-icon name="pencil-outline"></ion-icon>
                                        </a>
                                        <a href="{{ route('time.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
