@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <h1 class="form-title text-center">Tambah Genre</h1>
        <form action="{{ route('time.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Jam Tayang</label>

                {!! Form::time('jamTayang', null, ['class' => 'form-control']) !!}

                @error('jamTayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>


               {!! Form::date('tanggalTayang', null, ['class' => 'form-control']) !!}

                @error('tanggalTayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">
                Tambah
            </button>
        </form>
    </div>
</div>
@endsection
