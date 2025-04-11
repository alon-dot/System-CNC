<table class="table table-hover shadow-lg" style="border-radius: 12px; overflow: hidden;">
    <thead class="thead-dark">
        <tr style="background-color: #444; color: white;">
            <th>Material de Herramienta</th>
            <th>Materia Prima</th>
            <th>Diámetro (mm)</th>
            <th>Número de Dientes</th>
            <th>Velocidad de Corte (m/min)</th>
            <th>RPM</th>
            <th>Avance de Corte</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($acabadols as $acabadol)
            <tr style="background-color: #f8f8f8;">
                <td>{{ $acabadol->material_herramienta }}</td>
                <td>{{ $acabadol->materia_prima }}</td>
                <td>{{ $acabadol->diametro_herramienta }}</td>
                <td>{{ $acabadol->numero_dientes }}</td>
                <td>{{ $acabadol->velocidad_corte }}</td>
                <td>{{ $acabadol->rpm }}</td>
                <td>{{ $acabadol->avance_corte }}</td>
                <td>
                    <div class="d-inline-flex">
                    <a class="btn btn-sm btn-primary" href="{{ route('acabadols.show', $acabadol->id) }}">
                    <i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}
                    </a>
                    {{-- Botón de eliminar --}}
                    <form action="{{ route('acabadols.destroy', $acabadol) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete" onclick="confirmDelete(this)">
                            Eliminar
                        </button>
                    </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No se encontraron resultados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Paginación --}}
<div class="d-flex justify-content-center mt-3">
    {{ $acabadols->links() }}
</div>
