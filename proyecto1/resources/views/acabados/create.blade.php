@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="color: #444;">Agregar Operación de Acabado</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error',
                text: "Por favor corrige los errores y vuelve a intentarlo.",
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        </script>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de Operación de Acabado --}}
    <label style="color: red;">{{ __('Datos obligatorios *') }}</label><br><br>

    <div class="card shadow p-4" style="background-color: white; border-radius: 15px; border: 1.5px solid #FFCC00;">
        <form action="{{ route('acabados.store') }}" method="POST" id="acabadoForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="material_herramienta">Material de la Herramienta*</label>
                    <select name="material_herramienta" id="material_herramienta" class="form-control" required>
                        <option value="Carburo">Carburo de tungsteno</option>
                        <!-- Otras opciones -->
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
                    <option value="3.1750">3.175</option>
                    <option value="4.7625">4.7625</option>
                        <option value="6.3500">6.35</option>
                        <option value="9.5250">9.525</option>
                        <option value="12.7000">12.7</option>
                        <option value="15.8750">15.8750</option>
                        <option value="19.0500">19.05</option>
                        <option value="25.4000">25.4000</option>
                        <!-- Otras opciones -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="numero_dientes">Número de Dientes*</label>
                    <select name="numero_dientes" id="numero_dientes" class="form-control" required>
                    <option value="4">4</option>    
                        <!-- Otras opciones -->
                    </select>
                </div>
            </div>

            <center>
                <div>
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button> 
                    <a href="{{ route('acabados.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
                </div>
            </center>
        </form>
    </div>

    {{-- Resultados --}}
    @if (session('rpm') && session('avance_corte'))
        <div class="mt-4">
            <div class="bg-white text-dark p-4" style="border-radius: 12px; border: 1px solid #ccc;">
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
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    // Al enviar el formulario, mostrar SweetAlert2
    document.getElementById('acabadoForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío temporalmente
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
                form.submit(); // Enviar el formulario si se confirma
            }
        });
    });

    // Mostrar mensaje de éxito con SweetAlert2 si los datos se guardan correctamente
    @if (session('status'))
        Swal.fire({
            title: '¡Datos guardados!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
        });
    @endif
</script>
{{-- Estilos personalizados --}}
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

    .container {
        background-color: while;
        padding: 20px;
        border-radius: 15px;
    }

    .bg-white {
        background-color: #ffffff; /* Fondo blanco */
    }

    .text-dark {
        color: #000000; /* Texto negro */
    }

    .p-4 {
        padding: 20px;
    }
</style>
@endsection
