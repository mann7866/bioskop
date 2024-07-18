@extends('layouts.app')

@section('content')
    @if (session('success'))
       <marquee behavior="left" direction="right">
        <div class="alert alert-success pos">
            {{ session('success') }}
        </div>
       </marquee>
    @endif
    <style>
        .pos{
            display: flex;
            width: 200px;
            height: 100%;
        }
        .warning {
            background-color: hsl(202, 100%, 50%);
            color: blue;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            transition: 3s ease;
        }

        .warning:hover {
            box-shadow: #00ffaa;
        }
    </style>
    <div>
        <a class="btn btn-outline-primary m-3 mt-3 warning" href="{{ route('time.create') }}">
            <i class="fas fa-plus"></i> Tambah Time
        </a>
    </div>
    <div class="card-body mt-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                <thead>

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
                                    Edit
                                </a>
                                <a href="{{ route('time.delete', $item->id) }}">
                                    <button type="button" class="btn btn-danger"
                                        onclick="return confirm('yakin ingin Menghapus')">delete</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
