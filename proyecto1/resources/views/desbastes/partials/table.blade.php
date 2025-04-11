<table class="table table-hover shadow-lg" style="border-radius: 12px; overflow: hidden;">
    <thead class="thead-dark">
        <tr style="background-color: #444; color: white;">
            <th>Material Herramienta</th>
            <th>Materia Prima</th>
            <th>Diámetro Herramienta (mm)</th>
            <th>Número de Dientes</th>
            <th>Velocidad Corte (m/min)</th>
            <th>RPM</th>
            <th>Avance de Corte (mm/min)</th>
            <th>Profundidad máxima de corte (mm)</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($desbastes as $desbaste)
        <tr style="background-color: #f8f8f8;">
            <td>{{ $desbaste->material_herramienta }}</td>
            <td>{{ $desbaste->materia_prima }}</td>
            <td>{{ $desbaste->diametro_herramienta }}</td>
            <td>{{ $desbaste->numero_dientes }}</td>
            <td>{{ $desbaste->velocidad_corte }}</td>
            <td>{{ $desbaste->rpm }}</td>
            <td>{{ $desbaste->avance_corte }}</td>
            <td>{{ $desbaste->profundidad_maxima }}</td>
            <td>
                <div class="d-inline-flex">
                    <button type="button" class="btn btn-info btn-sm mr-1" onclick="verDetalles({{ $desbaste->id }})">
                        Ver
                    </button>
                    <form action="{{ route('desbastes.destroy', $desbaste->id) }}" method="POST" style="display: inline;">
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

{{-- Links de paginación --}}
<div class="d-flex justify-content-center">
    {{ $desbastes->links() }}
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
