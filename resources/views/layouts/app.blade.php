<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NihonFlix') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('Logo/Dreamland Theater.jpg') }}">
    <!-- link datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- toaster --}}
        {{-- @include('Componen.css')
        @include('Componen.script') --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Sebelum penutup </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    {{-- css --}}
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <button class="nav-link btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <ion-icon name="menu-outline" class="size"></ion-icon>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'NihonFlix') }}
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('genre.tampilan') }}">{{ __('Genres') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('film') }}">{{ __('Film') }}</a>
                        </li>
                        
                    </ul>
                    <!-- Center Search Form -->
                    @yield('search')
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center ">
                        <a href="{{ route('order.index') }}"><ion-icon name="cart" class="size-icon"></ion-icon></a>
                        <!-- Color Change Dropdown -->
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarColorDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="color-palette-outline" class="size"></ion-icon>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end posmen navbar-tog"
                                aria-labelledby="navbarColorDropdown">
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-light')"><ion-icon name="caret-forward"></ion-icon>Light</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-dark')"><ion-icon name="caret-forward"></ion-icon>Dark</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-secondary')"><ion-icon name="caret-forward"></ion-icon>Secondary</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-success')"><ion-icon name="caret-forward"></ion-icon>Success</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-danger')"><ion-icon name="caret-forward"></ion-icon>Danger</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-primary-rgba')"><ion-icon name="caret-forward"></ion-icon>Rgba</button></li>
                            </ul>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Offcanvas Content -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text" id="offcanvasScrollingLabel">Option</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <li>
                    <a class="dropdown-item" href="{{ route('genre') }}">Genres</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('time') }}">Time</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('detail') }}">Tambah Film</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('kursi') }}">Tambah Kursi</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('berita') }}">Tambah Berita</a>
                </li>
            </ul>
        </div>
    </div>
    <footer>
        @include('footer.footer')
    </footer>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Isotope -->
    <link rel="stylesheet" href="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.css">
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- AOS JavaScript -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Dark Mode Toggle Script -->
    <script>
        function changeNavbarColor(colorClass) {
            const navbar = document.querySelector('.navbar');
            navbar.className = `navbar navbar-expand-md ${colorClass} shadow-sm sticky-top`;
            localStorage.setItem('navbar-color', colorClass);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const savedColor = localStorage.getItem('navbar-color');
            if (savedColor) {
                changeNavbarColor(savedColor);
            }
        });
    </script>

</body>

</html>
