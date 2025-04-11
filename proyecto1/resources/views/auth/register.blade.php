@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background-color: white;">
    <div class="container shadow-lg" style="border-radius: 1.5rem; overflow: hidden; max-width: 900px;">
        <div class="row">
            
            <!-- Left Side with Image -->
            <div class="col-md-6 d-none d-md-block" style="background-image: url('https://i.ibb.co/M9zRPGg/logo.jpg'); background-size: cover; background-position: center;">
                <div class="h-100 d-flex align-items-center justify-content-center text-white p-2"></div>
            </div>
            
            <!-- Right Side with Login Form -->
            <div class="col-md-6 bg-white">
                <div class="card border-0 h-100" style="background-color: rgba(255, 255, 255, 0.85);">
                    <div class="card-body py-5 px-5">
                        <h3 class="text-center text-warning mb-4" style="font-weight: 400; font-size: 1rem;">{{ __('Registrar usuarios nuevos') }}</h3>


                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirma tu contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary text-white" 
                                    style="background-color: #FFC107; border-color: #FFC107;"> 
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
