@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="display-4">404</h1>
        <p class="lead">[😭]|Iam Sory Not Videos</p>
        {{-- #di bawah jika kosong akan Error Undefined variable $query --}}
        <p>Tidak ada hasil yang ditemukan untuk pencarian "<strong>{{ $query }}</strong>".</p>
        {{-- #Di bawah jika query kosong bisa muncul 404  --}}
        {{-- <p>Tidak ada hasil yang ditemukan untuk pencarian "<strong>{{ $query }}</strong>".</p> --}}
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
@endsection
