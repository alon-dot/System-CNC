@extends('layouts.app')

@section('template_title')
    {{ __('Calcular Desbaste') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Calculo para Desbaste') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('calcular') }}" role="form">
                            @csrf

                            <div class="form-group">
                                <label for="materialHerramienta">Material de la Herramienta</label>
                                <select name="materialHerramienta" class="form-control">
                                    <option value="Carburo de tungsteno">Carburo de tungsteno</option>
                                    <option value="Acero rápido">Acero rápido</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="materiaPrima">Materia Prima</label>
                                <select name="materiaPrima" class="form-control">
                                    <option value="Acrilico(PMMA)">Acrílico(PMMA)</option>
                                    <option value="Aluminio">Aluminio 6061 T6</option>
                                    <option value="Acero">Acero 1018</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="diametroHerramienta">Diámetro de la Herramienta (mm)</label>
                                <input type="number" name="diametroHerramienta" class="form-control" step="0.01" value="6.35" required>
                            </div>

                            <div class="form-group">
                                <label for="numeroFilos">Número de Filos</label>
                                <input type="number" name="numeroFilos" class="form-control" value="2" required>
                            </div>

                            <div class="form-group">
                                <label for="velocidadCorte">Velocidad de Corte (m/min)</label>
                                <input type="number" name="velocidadCorte" class="form-control" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="avancePorDiente">Avance por Diente (mm)</label>
                                <input type="number" name="avancePorDiente" class="form-control" step="0.01" required>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Calcular</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
