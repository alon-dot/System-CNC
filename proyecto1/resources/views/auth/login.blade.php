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
        .bg-silver { background-color: silver !important; }

        /* Logo and Navbar Styles */
        .logo-container img {
            border-radius: 50%;
            width: 70px;
        }
        .navbar-brand { font-weight: bold; color: #343a40; font-size: 1.5rem; }
        .navbar-brand:hover { color: #d9534f; }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-silver shadow-sm">
            <div class="container">
                <div class="logo-container">
                    <img src="https://i.ibb.co/M9zRPGg/logo.jpg" alt="Logo">
                    <a class="navbar-brand" href="{{ url('/welcome') }}">M-RAM CNC</a>
                </div>
            </div>
        </nav>

        <!-- Page Content - Login Form -->
        <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background-color: white;">
            <div class="container shadow-lg" style="border-radius: 1.5rem; overflow: hidden; max-width: 900px;">
                <div class="row">
                    
                    <!-- Left Side with Image -->
                    <div class="col-md-6 d-none d-md-block" style="background-image: url('https://i.ibb.co/M9zRPGg/logo.jpg'); background-size: cover; background-position: center;">
                        <div class="h-100 d-flex align-items-center justify-content-center text-white p-4"></div>
                    </div>
                    
                    <!-- Right Side with Login Form -->
                    <div class="col-md-6 bg-white">
                        <div class="card border-0 h-100" style="background-color: rgba(255, 255, 255, 0.85);">
                            <div class="card-body py-5 px-5">
                                <h3 class="text-center text-warning mb-4" style="font-weight: 700; font-size: 2rem;">{{ __('Iniciar Sesión') }}</h3>
                                
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Field -->
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white" style="border-radius: 50px 0 0 50px;"><i class="fas fa-envelope"></i></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico" style="border-radius: 0 50px 50px 0;">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password Field -->
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-white" style="border-radius: 50px 0 0 50px;"><i class="fas fa-lock"></i></span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña" style="border-radius: 0 50px 50px 0;">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Remember Me and Forgot Password -->
                                    <div class="form-group mb-4 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Recordarme') }}
                                            </label>
                                        </div>
                                        
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg text-white rounded-pill shadow" 
                                            style="font-weight: 600; background-color: #FFC107; border-color: #FFC107;">
                                            {{ __('Acceder') }}
                                        </button>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
