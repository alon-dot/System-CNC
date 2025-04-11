@extends('layouts.admin')

@section('template_title')
    {{ $alumno->name ?? __('Show') . " " . __('Alumno') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-warning">
                    <div class="card-header bg-warning text-dark" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h5 class="card-title mb-0 text-dark">{{ __('Detalles del Alumno') }}</h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-light btn-sm" href="{{ route('alumnos.index') }}">
                                <i class="fas fa-arrow-left"></i> {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Nombre:') }}</strong>
                                    <p class="form-control-plaintext">{{ $alumno->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Usuario:') }}</strong>
                                    <p class="form-control-plaintext">{{ $alumno->usuario }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Matrícula:') }}</strong>
                                    <p class="form-control-plaintext">{{ $alumno->matricula }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Cuatrimestre:') }}</strong>
                                    <p class="form-control-plaintext">{{ $alumno->cuatrimestre }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Agregar más detalles si es necesario --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
