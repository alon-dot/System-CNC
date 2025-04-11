@extends('layouts.admin')

@section('template_title')
    {{ __('Crear') }} Alumno
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-warning">
                    <div class="card-header bg-warning text-dark" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h5 class="card-title mb-0">{{ __('Crear Alumno') }}</h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-light btn-sm" href="{{ route('alumnos.index') }}">
                                <i class="fas fa-arrow-left"></i> {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('alumnos.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            {{-- Aquí incluirás los campos del formulario --}}
                            @include('alumno.form')

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Al enviar el formulario, mostrar SweetAlert2 para confirmar el envío
    document.getElementById('alumnoForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío del formulario temporalmente
        let form = this;

        Swal.fire({
            title: '¿Confirmar envío?',
            text: "Los datos del alumno serán guardados.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario
                form.submit();
            }
        });
    });

    // Mostrar mensaje de éxito con SweetAlert2 si los datos se guardan correctamente
    @if (session('success'))
        Swal.fire({
            title: '¡Alumno creado!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
        });
    @endif
</script>

 
@endsection
