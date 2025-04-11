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
        @forelse ($acabados as $acabado)
            <tr style="background-color: #f8f8f8;">
                <td>{{ $acabado->material_herramienta }}</td>
                <td>{{ $acabado->materia_prima }}</td>
                <td>{{ $acabado->diametro_herramienta }}</td>
                <td>{{ $acabado->numero_dientes }}</td>
                <td>{{ $acabado->velocidad_corte }}</td>
                <td>{{ $acabado->rpm }}</td>
                <td>{{ $acabado->avance_corte }}</td>
                <td>
                    <div class="d-inline-flex">
                        <button type="button" class="btn btn-info btn-sm mr-1" onclick="verDetalles({{ $acabado->id }})">
                            Ver
                        </button>
                        {{-- Botón de eliminar --}}
                        <form action="{{ route('acabados.destroy', $acabado) }}" method="POST" style="display:inline;">
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
                <td colspan="9" class="text-center">No se encontraron resultados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Paginación --}}
<div class="d-flex justify-content-center mt-4">
    {{ $acabados->links('pagination::bootstrap-4') }}
</div>

<!-- Modal -->
<div class="modal fade" id="verDetallesModal" tabindex="-1" role="dialog" aria-labelledby="verDetallesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verDetallesModalLabel">Detalles de la Operación</h5>
            </div>
            <div class="modal-body">
                <!-- Aquí se cargarán los detalles -->
                <ul id="detallesLista">
                    <!-- Datos cargados dinámicamente -->
                </ul>
            </div>
        </div>
    </div>
</div>
