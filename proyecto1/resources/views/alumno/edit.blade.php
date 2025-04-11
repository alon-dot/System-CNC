@extends('layouts.admin')

@section('template_title')
    {{ __('Actualizar') }} Alumno
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg border-warning">
                    <div class="card-header bg-warning text-dark" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h5 class="card-title mb-0">{{ __('Actualizar Alumno') }}</h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-light btn-sm" href="{{ route('alumnos.index') }}">
                                <i class="fas fa-arrow-left"></i> {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('alumnos.update', $alumno->id) }}" role="form" enctype="multipart/form-data" id="updateForm">
                            {{ method_field('PATCH') }}
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
        document.getElementById('updateButton').addEventListener('click', function() {
            document.getElementById('updateForm').submit();  // Este método enviará el formulario manualmente
        });
    </script>
@endsection
