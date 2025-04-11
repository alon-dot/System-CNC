@extends('layouts.app')

@section('template_title')
    {{ $acabadol->name ?? __('Show') . " " . __('Acabadol') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-warning">
                    <div class="card-header bg-warning text-dark" style="display: flex; justify-content: space-between; align-items: center;">
                        <h5 class="card-title mb-0 text-dark">{{ __('Detalles del Acabado') }}</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('acabadols.index') }}">
                            <i class="fas fa-arrow-left"></i> {{ __('Regresar') }}
                        </a>
                    </div>

                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Material Herramienta:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->material_herramienta }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Materia Prima:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->materia_prima }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Diámetro Herramienta:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->diametro_herramienta }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Número Dientes:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->numero_dientes }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Velocidad Corte:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->velocidad_corte }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Rpm:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->rpm }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong class="text-dark">{{ __('Avance Corte:') }}</strong>
                                    <p class="form-control-plaintext">{{ $acabadol->avance_corte }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
