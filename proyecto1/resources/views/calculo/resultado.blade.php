@extends('layouts.app')

@section('template_title')
    Resultado del Cálculo
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Resultado del Cálculo</div>

                    <div class="card-body">
                        <p><strong>RPM:</strong> {{ $rpm }}</p>
                        <p><strong>Avance de Corte:</strong> {{ $avanceCorte }}</p>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
