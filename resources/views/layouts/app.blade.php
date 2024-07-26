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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Sebelum penutup </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Custom CSS -->
    <style>
        .dropdown-item:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .dropdown-item {
            transition: color 0.3s, text-decoration 0.3s;
        }

        .navbar-brand {
            margin-right: 20px;
        }

        .nav-link {
            display: flex;
            align-items: center;
        }

        .nav-link ion-icon {
            margin-right: 5px;
        }

        .size {
            font-size: 30px;
            /* Adjust the font size as needed */
            width: 30px;
            /* Adjust the width as needed */
            height: 30px;
            /* Adjust the height as needed */
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
            }

            .navbar-collapse {
                margin-top: 10px;
            }
        }

        @media (max-width: 576px) {
            .size {
                font-size: 24px;
                /* Adjust the font size for small screens */
                width: 24px;
                /* Adjust the width for small screens */
                height: 24px;
                /* Adjust the height for small screens */
            }

            .film-card {
                flex: 0 0 calc(50% - 20px);
            }

            .film-container {
                padding: 5px;
            }
        }

        /* Dark Mode Styles */
        body,
        .navbar,
        .card,
        .dropdown-menu,
        .modal-content {
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .navbar,
        .dark-mode .card,
        .dark-mode .dropdown-menu,
        .dark-mode .modal-content {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .btn-outline-success {
            border-color: #e0e0e0;
            color: #e0e0e0;
        }

        .dark-mode .btn-outline-success:hover {
            background-color: #333;
        }

        .dark-mode .btn-dark {
            background-color: #333;
            border: none;
        }

        .dark-mode .btn-dark:hover {
            background-color: #444;
        }

        /* Custom CSS for Navbar Colors */
        .navbar-light {
            background-color: #f8f9fa !important;
            color: blue;
        }

        .navbar-dark {
            background-color: #343a40 !important;
            color: #ffffff !important;
        }

        .navbar-primary {
            background-color: #007bff !important;
            color: #ffffff !important;
        }

        .navbar-secondary {
            background-color: #6c757d !important;
            color: #ffffff !important;
        }

        .navbar-success {
            background-color: #28a745 !important;
            color: #ffffff !important;
        }

        .navbar-danger {
            background-color: #dc3545 !important;
            color: #ffffff !important;
        }
        .navbar-primary-rgba{
            background-color: rgba(31, 172, 171, 0.8);
            color: aqua;
        }
    </style>
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
                    {{ config('app.name', 'Bioskop') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('genre') }}">{{ __('Genres') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('film') }}">{{ __('Film') }}</a>
                        </li>

                    </ul>

                    <!-- Center Search Form -->
                    <form action="{{ route('search') }}" class="d-flex mx-auto" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>

                    <a href="{{ route('order.index') }}" style="color: black"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708"/>
                      </svg></a>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center ">
                        <!-- Color Change Dropdown -->
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarColorDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="color-palette-outline" class="size"></ion-icon>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end posmen navbar-tog" aria-labelledby="navbarColorDropdown">
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-light')">Light</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-dark')">Dark</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-primary')">Primary</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-secondary')">Secondary</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-success')">Success</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-danger')">Danger</button></li>
                                <li><button class="dropdown-item"
                                        onclick="changeNavbarColor('navbar-primary-rgba')">Rgba</button></li>
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
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Fitur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li>
                    <a class="dropdown-item" href="{{ route('genre') }}">Genres</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('time') }}">Time</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('detail') }}">Add Film</a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('berita') }}">Add Berita</a>
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
