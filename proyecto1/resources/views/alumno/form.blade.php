<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">

        <label style="color: red;">{{ __('Datos obligatorios *') }}</label><br><br>

            <label for="nombre" class="form-label">{{ __('Nombre completo*') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                   value="{{ old('nombre', $alumno?->nombre) }}" id="nombre" placeholder="Nombre completo"
                   pattern="^[A-Za-zÀ-ÿ\s]+$" title="El nombre no puede contener números ni caracteres especiales">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="usuario" class="form-label">{{ __('Usuario*') }}</label>
            <input type="text" name="usuario" class="form-control @error('usuario') is-invalid @enderror" 
                   value="{{ old('usuario', $alumno?->usuario) }}" id="usuario" placeholder="Usuario">
            {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="matricula" class="form-label">{{ __('Matrícula*') }}</label>
            <input type="text" name="matricula" class="form-control @error('matricula') is-invalid @enderror" 
                   value="{{ old('matricula', $alumno?->matricula) }}" id="matricula" placeholder="Matrícula" maxlength="15">
            {!! $errors->first('matricula', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="cuatrimestre" class="form-label">{{ __('Cuatrimestre*') }}</label>
            <input type="text" name="cuatrimestre" class="form-control @error('cuatrimestre') is-invalid @enderror" 
                   value="{{ old('cuatrimestre', $alumno?->cuatrimestre) }}" id="cuatrimestre" placeholder="Cuatrimestre"
                   pattern="^\d+$" title="El cuatrimestre solo puede contener números" maxlength="2">
            {!! $errors->first('cuatrimestre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group text-center mt-4">
                                {{-- Botón para cancelar --}}
                                <a href="{{ route('alumnos.index') }}" class="btn btn-secondary btn-lg rounded-pill shadow mr-3">
                                    {{ __('Cancelar') }}
                                </a>

                                {{-- Botón para guardar --}}
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow">
                                    {{ __('Guardar Alumno') }}
                                </button>
                            </div>
    </div>
</div>
