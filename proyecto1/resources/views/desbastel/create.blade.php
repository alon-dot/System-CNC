@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="color: #444;">Agregar Nueva Operación de Desbaste</h2>

    {{-- Formulario para agregar operación de desbastel --}}
    <label style="color: red;">{{ __('Datos obligatorios *') }}</label><br><br>

    <div class="card shadow p-4" style="background-color: white; border-radius: 15px; border: 1.5px solid #FFCC00;">
        <form action="{{ route('desbastels.store') }}" method="POST" id="desbastelForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="material_herramienta">Material de la Herramienta*</label>
                    <select name="material_herramienta" id="material_herramienta" class="form-control" required>
                        <option value="Carburo de tungsteno">Carburo de tungsteno</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="materia_prima">Materia Prima*</label>
                    <select name="materia_prima" id="materia_prima" class="form-control" required>
                    <option value="Aluminio aleado al magnesio-silicio 6061 T6">Aluminio aleado al magnesio-silicio 6061 T6</option>
                    <option value="Aluminio aleado al cobre 2024 T3">Aluminio aleado al cobre 2024 T3</option>
                    <option value="Aluminio aleado al magnesio 5052 T4">Aluminio aleado al magnesio 5052 T4</option>
                    <option value="Aluminio aleado al zinc 7075 T651">Aluminio aleado al zinc 7075 T651</option>
                    <option value="Acero de bajo contenido de carbono 1018">Acero de bajo contenido de carbono 1018</option>
                    <option value="Acero de medio contenido de carbono 1045">Acero de medio contenido de carbono 1045</option>
                    <option value="Acero de alto contenido de carbono 1060">Acero de alto contenido de carbono 1060</option>
                    <option value="Acero aleado al cromo-molibdeno  4140">Acero aleado al cromo-molibdeno  4140</option>
                    <option value="Acero aleado al cromo 5120">Acero aleado al cromo 5120</option>
                    <option value="Acero aleado al níquel-cromo-molibdeno 8620">Acero aleado al níquel-cromo-molibdeno 8620</option>
                    <option value="Acero Inoxidable Ferrítico 409">Acero Inoxidable Ferrítico 409</option>
                    <option value="Acero Inoxidable Martensítico AISI 416">Acero Inoxidable Martensítico AISI 416</option>
                    <option value="Acero Inoxidable Austenítico 304">Acero Inoxidable Austenítico 304</option>
                    <option value="Acero estructural A36">Acero estructural A36</option>
                    <option value="Acero grado herramienta A2">Acero grado herramienta A2</option>
                    <option value="Acero grado herramienta W1">Acero grado herramienta W1</option>
                    <option value="Acero grado herramienta D2">Acero grado herramienta D2</option>
                    <option value="Acero grado herramienta H13">Acero grado herramienta H13</option>
                    <option value="Acero grado herramienta P20">Acero grado herramienta P20</option>
                    <option value="Acero grado herramienta O1">Acero grado herramienta O1</option>  
                        <!-- Otras opciones -->
                    </select>
                </div>
            
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="diametro_herramienta">Diámetro de la Herramienta (mm)*</label>
                    <select name="diametro_herramienta" id="diametro_herramienta" class="form-control" required>
                    <option value="3.1750">3.1750</option>
                    <option value="4.7625">4.7625</option>
                        <option value="6.3500">6.3500</option>
                        <option value="9.5250">9.5250</option>
                        <option value="12.7000">12.7000</option>
                        <option value="15.8750">15.8750</option>
                        <option value="19.0500">19.0500</option>
                        <option value="25.4000">25.4000</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="numero_dientes">Número de Dientes*</label>
                    <select name="numero_dientes" id="numero_dientes" class="form-control" required>
                    <option value="4">4</option>    
                    </select>
                </div>
            </div>

            <center>
                <button type="submit" class="btn btn-primary btn-block mt-4">Guardar</button>
                <a href="{{ route('desbastels.index') }}" class="btn btn-secondary btn-block mt-4">Cancelar</a>
            </center>
        </form>
    </div>

    {{-- Resultados --}}
    @if (session('rpm') && session('avance_corte'))
    <div class="mt-4">
        <div class="bg-white text-dark p-4 resultado-redondeado">
            <h5 class="text-center">Resultados</h5>
            <div class="row">
                <div class="col text-center">
                    <p class="font-weight-bold">RPM:</p>
                    <p>{{ session('rpm') }}</p>
                </div>
                <div class="col text-center">
                    <p class="font-weight-bold">Avance de Corte (mm/min):</p>
                    <p>{{ session('avance_corte') }}</p>
                </div>
                <div class="col text-center">
                    <p class="font-weight-bold">Profundidad Máxima de Corte (mm):</p>
                    <p>{{ session('profundidad_maxima') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
</div>

<script>
    document.getElementById('desbastelForm').addEventListener('submit', function(event) {
        event.preventDefault(); 
        let form = this;

        Swal.fire({
            title: '¿Confirmar envío?',
            text: "Los datos serán guardados.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    @if (session('status'))
        Swal.fire({
            title: '¡Datos guardados!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
        });
    @endif
</script>

<style>
    .btn-primary {
        background-color: #ffcc00;
        color: #444;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffdd44;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: #6c757d;
        border-radius: 25px;
        padding: 10px 20px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
    }

    .card {
        background-color: #f8f8f8;
        border: none;
    }

    .container {
        background-color: while;
        padding: 20px;
        border-radius: 15px;
    }
</style>
@endsection
