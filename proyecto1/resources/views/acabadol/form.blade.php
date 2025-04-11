<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="material_herramienta" class="form-label">{{ __('Material Herramienta') }}</label>
            <input type="text" name="material_herramienta" class="form-control @error('material_herramienta') is-invalid @enderror" value="{{ old('material_herramienta', $acabadol?->material_herramienta) }}" id="material_herramienta" placeholder="Material Herramienta">
            {!! $errors->first('material_herramienta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="materia_prima" class="form-label">{{ __('Materia Prima') }}</label>
            <input type="text" name="materia_prima" class="form-control @error('materia_prima') is-invalid @enderror" value="{{ old('materia_prima', $acabadol?->materia_prima) }}" id="materia_prima" placeholder="Materia Prima">
            {!! $errors->first('materia_prima', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="diametro_herramienta" class="form-label">{{ __('Diametro Herramienta') }}</label>
            <input type="text" name="diametro_herramienta" class="form-control @error('diametro_herramienta') is-invalid @enderror" value="{{ old('diametro_herramienta', $acabadol?->diametro_herramienta) }}" id="diametro_herramienta" placeholder="Diametro Herramienta">
            {!! $errors->first('diametro_herramienta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_dientes" class="form-label">{{ __('Numero Dientes') }}</label>
            <input type="text" name="numero_dientes" class="form-control @error('numero_dientes') is-invalid @enderror" value="{{ old('numero_dientes', $acabadol?->numero_dientes) }}" id="numero_dientes" placeholder="Numero Dientes">
            {!! $errors->first('numero_dientes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="velocidad_corte" class="form-label">{{ __('Velocidad Corte') }}</label>
            <input type="text" name="velocidad_corte" class="form-control @error('velocidad_corte') is-invalid @enderror" value="{{ old('velocidad_corte', $acabadol?->velocidad_corte) }}" id="velocidad_corte" placeholder="Velocidad Corte">
            {!! $errors->first('velocidad_corte', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="rpm" class="form-label">{{ __('Rpm') }}</label>
            <input type="text" name="rpm" class="form-control @error('rpm') is-invalid @enderror" value="{{ old('rpm', $acabadol?->rpm) }}" id="rpm" placeholder="Rpm">
            {!! $errors->first('rpm', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="avance_corte" class="form-label">{{ __('Avance Corte') }}</label>
            <input type="text" name="avance_corte" class="form-control @error('avance_corte') is-invalid @enderror" value="{{ old('avance_corte', $acabadol?->avance_corte) }}" id="avance_corte" placeholder="Avance Corte">
            {!! $errors->first('avance_corte', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>