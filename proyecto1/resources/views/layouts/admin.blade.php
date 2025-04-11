<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>


        .bg-silver { background-color: rgb(143,143,143) !important; }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            transform: translateX(100%);
            transition: transform 0.4s ease-in-out;
            z-index: 1050;
            padding-top: 60px;
        }
        .sidebar.show { transform: translateX(0); }
        .sidebar .list-group-item {
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 1.1rem;
            transition: background-color 0.3s;
        }
        .sidebar .list-group-item:hover { background-color: #495057; }

        /* Menu Toggle Icon */
        .menu-toggle {
            position: fixed;
            top: 15px;
            right: 15px;
            width: 30px;
            height: 30px;
            cursor: pointer;
            z-index: 1100;
        }
        .menu-toggle .bar {
            width: 100%;
            height: 4px;
            background-color: #343a40;
            margin: 6px 0;
            transition: background-color 0.4s;
        }
        .menu-toggle:hover .bar { background-color: #d9534f; }

        /* Logo and Navbar Styles */
        
        .logo-container img {
            border-radius: 50%;
            width: 70px;
        }
        .navbar-brand { font-weight: bold; color: #343a40; font-size: 1.5rem; }
        .navbar-brand:hover { color: #d9534f; }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar { width: 100%; }
            .logo-container img { display: none; } /* Hide logo on smaller screens */
            .navbar { justify-content: center; } /* Center navbar items on mobile */
        }
    </style>
    @laravelPWA
</head>
<body>
    <div id="app">
        <!-- Sidebar Toggle -->
        <div class="menu-toggle" onclick="toggleSidebar(this)">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
        </div>

       <!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="list-group list-group-flush">
        <div class="list-group-item bg-dark text-white text-center">
            {{ Auth::user()->name }}
        </div>
        <a href="{{ url('/home') }}" class="list-group-item list-group-item-action">Inicio</a>
        <a href="{{ url('/alumnos') }}" class="list-group-item list-group-item-action">Usuarios</a>
        <a href="{{ url('/acabados') }}" class="list-group-item list-group-item-action">Acabado</a>
        <a href="{{ url('/desbastes') }}" class="list-group-item list-group-item-action">Desbaste</a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           {{ __('Cerrar sesión') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>



        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-silver shadow-sm">
            <div class="container">
                <div class="logo-container">
                    <img src="https://i.ibb.co/M9zRPGg/logo.jpg" alt="Logo">
                    <a class="navbar-brand" href="{{ url('/home') }}">M-RAM CNC</a>
                </div>
                
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4 py-4">@yield('content')</main>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-light text-center text-lg-start mt-auto">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Todos los derechos reservados: M-RAM CNC
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar(toggle) {
            document.getElementById("sidebar").classList.toggle("show");
            toggle.classList.toggle("active");
        }
    </script>
</body>
</html>