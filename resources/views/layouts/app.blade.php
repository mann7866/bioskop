<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bioskop') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('Logo/Dreamland Theater.jpg') }}">
    <!-- link datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                    <ul class="navbar-nav me-auto nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('genre') }}">{{ __('Genres') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('detail') }}">{{ __('Film') }}</a>
                        </li>
                    </ul>

                    <!-- Center Search Form -->
                    <form action="#" class="d-flex mx-auto" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="query">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Dark Mode Toggle Button -->
                        <li class="nav-item">
                            <button id="darkModeToggle" class="nav-link">
                                <ion-icon name="moon-outline" class="size"></ion-icon>
                            </button>
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

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                    <a class="dropdown-item" href="{{ route('kursi') }}">Kursi</a>
                </li>
            </ul>
        </div>
    </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            // di pindah di button 
            const darkModeToggle = document.getElementById('darkModeToggle');
            darkModeToggle.onclick = function() {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));
            };

            // Check and apply the saved dark mode preference
            if (localStorage.getItem('dark-mode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>

</html>
