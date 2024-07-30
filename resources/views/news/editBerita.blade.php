@extends('layouts.app')

@section('content')
    <style>
        /* Styling khusus untuk form */
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            margin-bottom: 20px;
        }
    </style>
    <form class="row g-3 needs-validation" action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data"
        novalidate>
        @csrf
        @method('put')
        <div class="container mt-4">
            <div class="form-container">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Foto</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="foto_deskripsi" class="form-control" id="inputGroupFile" onchange="previewImage(event)">
                                            <label class="input-group-text" for="inputGroupFile">Upload</label>
                                        </div>
                                        @error('foto_deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <img id="imagePreview" src="{{ asset('imageBerita/' .$berita->foto_deskripsi) }}" class="mt-2" style="max-width: 200px; max-height: 200px; display: block;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">

                        <div class="col-md-6">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ $berita->judul }}">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                               >{{ $berita->deskripsi }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit ">
                            Order
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        // Function to preview image
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.style.display = 'block';
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Event listener for file input change
        document.getElementById('inputGroupFile').addEventListener('change', previewImage);

        // JavaScript for Bootstrap form validation
        (function() {
            'use strict';

            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    </script>
@endsection
