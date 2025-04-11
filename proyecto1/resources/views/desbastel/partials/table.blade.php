{{-- Tabla de operaciones --}}
        <table class="table table-hover shadow-lg" id="desbastels-table" style="border-radius: 12px; overflow: hidden;">
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
                @forelse ($desbastels as $desbastel)
                <tr style="background-color: #f8f8f8;">
                    <td>{{ $desbastel->material_herramienta }}</td>
                    <td>{{ $desbastel->materia_prima }}</td>
                    <td>{{ $desbastel->diametro_herramienta }}</td>
                    <td>{{ $desbastel->numero_dientes }}</td>
                    <td>{{ $desbastel->velocidad_corte }}</td>
                    <td>{{ $desbastel->rpm }}</td>
                    <td>{{ $desbastel->avance_corte }}</td>
                    <td>{{ $desbastel->profundidad_maxima }}</td>
                    <td>
                        <div class="d-inline-flex">
                            <a class="btn btn-sm btn-primary" href="{{ route('desbastels.show', $desbastel->id) }}">
                                <i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}
                            </a>
                            
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
<div class="d-flex justify-content-center">
    {{ $desbastels->links() }}
</div>