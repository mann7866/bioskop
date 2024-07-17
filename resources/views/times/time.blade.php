@extends('layouts.app')

@section('content')



@if (session('success'))
<div class="alert alert-success mt-3">
    {{ session('success') }}
</div>
@endif

<div>
    <a class="btn btn-primary  mt-5" href="{{ route('time.create') }}">
        Tambah time
    </a>
</div>
<div class="card-body mt-3">
    <div class="table-responsive">
        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
            <thead>

                <tr>
                    <th class="text-center">time</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($time as $item)
                <tr>
                    <td class="text-center">{{ $item->jamTayang }}</td>
                    <td class="text-center">{{ $item->tanggalTayang }}</td>
                    <td class="text-center">
                        <a href="{{ route('time.edit', $item->id) }}" class="btn btn-success">
                            Edit
                        </a>
                        <a href="{{ route('time.delete', $item->id) }}">
                            <button type="button" class="btn btn-danger" onclick="return confirm('yakin ingin Menghapus')">delete</button>
                        </a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>




    </div>
</div>

@endsection
