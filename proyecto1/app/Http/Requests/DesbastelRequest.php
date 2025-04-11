<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesbastelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'material_herramienta' => 'required|string',
			'materia_prima' => 'required|string',
			'diametro_herramienta' => 'required',
			'numero_dientes' => 'required',
			'velocidad_corte' => 'required',
			'profundidad_maxima' => 'required',
        ];
    }
}
