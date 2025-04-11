@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="color: #444;">Operaciones de Desbaste</h2>

    {{-- Botón para agregar una nueva operación --}}
    <div class="mb-3 text-center">
        <a href="{{ route('desbastels.create') }}" class="btn btn-add-operation">
            {{ __('+ Nueva Operación de Desbaste') }}
        </a>
    </div>

    {{-- Formulario de búsqueda --}}
    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Buscar" value="{{ request('search') }}">
    </div>

    <!-- Botón para descargar PDF -->
    <button id="download-pdf" class="btn btn-success mb-4">Descargar PDF</button>

    {{-- Tabla de operaciones --}}
    <div class="table-responsive" id="tableContainer">
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
                            <form action="{{ route('desbastels.destroy', $desbastel->id) }}" method="POST" style="display: inline;">
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

    </div>

   



<script>
    const tableContainer = document.getElementById('tableContainer');
    const searchInput = document.getElementById('search');

    // Búsqueda en tiempo real y actualización de tabla en AJAX
    searchInput.addEventListener('input', () => updateTable());

    function updateTable(page = 1) {
        const search = searchInput.value;

        fetch(`{{ route('desbastels.index') }}?search=${search}&page=${page}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(data => tableContainer.innerHTML = data)
        .catch(error => console.error('Error en la búsqueda:', error));
    }

    // Delegación de eventos para la paginación en AJAX
    document.addEventListener('click', function(e) {
        if (e.target.matches('.pagination a')) {
            e.preventDefault();
            const page = e.target.getAttribute('href').split('page=')[1];
            updateTable(page);
        }
    });

    // Confirmación para eliminar registros con SweetAlert
    function confirmDelete(button) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta operación no se podrá revertir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>






<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.getElementById('tableContainer');
    const searchInput = document.getElementById('search');
    let currentPage = 1;

    // Búsqueda en tiempo real y actualización de tabla en AJAX
    searchInput.addEventListener('input', () => updateTable());

    function updateTable(page = 1) {
        currentPage = page;
        const search = searchInput.value;

        fetch(`{{ route('desbastels.index') }}?search=${search}&page=${page}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(data => {
            tableContainer.innerHTML = data;

            // Actualizar estado de la paginación después de cambiar de página
            updatePagination();
        })
        .catch(error => console.error('Error en la búsqueda:', error));
    }

    // Delegación de eventos para la paginación en AJAX
    document.addEventListener('click', function(e) {
        if (e.target.matches('.pagination a')) {
            e.preventDefault();
            const page = e.target.getAttribute('href').split('page=')[1];
            updateTable(page);
        }
    });

    // Actualiza la paginación visual
    function updatePagination() {
        const paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            const page = link.getAttribute('href').split('page=')[1];
            if (parseInt(page) === currentPage) {
                link.parentElement.classList.add('active');
            } else {
                link.parentElement.classList.remove('active');
            }
        });
    }

    // Inicializa la tabla y la paginación al cargar la página
    updateTable();
});

    </script>


{{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.js"></script>

    <script>
        // Descargar tabla como PDF
        document.getElementById('download-pdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', [320, 320]); // Tamaño más grande (300mm x 300mm)
            
            // Establecer fuentes
            doc.setFont("Helvetica", "normal");
            doc.setFontSize(14); // Tamaño de fuente para el título

            // Agregar logo institucional (opcional)
            const logoUrl = 'https://i.ibb.co/52Q5sn1/logo.jpg'; // Asegúrate de poner el URL correcto o usar base64
            doc.addImage(logoUrl, 'PNG', 10, 10, 25, 25); // Ajustar tamaño y posición del logo

            // Título centrado con color institucional
            doc.setTextColor(0, 51, 102); // Color institucional (azul oscuro)
            const title = "Lista de Operaciones de Desbaste";
            doc.text(title, doc.internal.pageSize.width / 2, 30, { align: 'center' }); // Centrar el título

            // Fecha y hora de descarga
            const currentDate = new Date();
            const dateString = currentDate.toLocaleDateString();
            const timeString = currentDate.toLocaleTimeString();
            
            doc.setFontSize(10); // Tamaño de fuente para la fecha y hora
            doc.setTextColor(0, 0, 0); // Texto negro
            doc.text("Fecha de descarga: " + dateString, 14, 40);
            doc.text("Hora de descarga: " + timeString, 14, 50);

            // Definir las columnas y los datos
            const columns = [
                "Material de Herramienta", 
                "Materia Prima", 
                "Diámetro (mm)", 
                "Número de Dientes", 
                "Velocidad de Corte (m/min)", 
                "RPM", 
                "Avance de Corte (mm/min)",
                "Profundidad máxima de corte (mm)"
            ];

            const data = Array.from(document.querySelectorAll('#desbastels-table tbody tr')).map(row => {
                return Array.from(row.querySelectorAll('td')).slice(0, 8).map(cell => cell.textContent);
            });

            // Usar autoTable para agregar los datos a la tabla del PDF
            doc.autoTable({
                head: [columns],
                body: data,
                startY: 60, // Comienza la tabla después del título y la fecha
                margin: { top: 60, left: 20, right: 20 },
                tableWidth: 'wrap', // Ajusta la tabla al ancho disponible
                styles: {
                    cellPadding: 5, // Espaciado interno
                    fontSize: 10, // Tamaño de fuente para las celdas
                    overflow: 'linebreak', // Permitir el salto de línea en celdas
                    halign: 'center', // Alineación horizontal centrada
                    valign: 'middle', // Alineación vertical centrada
                    lineWidth: 0.5, // Grosor de las líneas de la tabla
                    lineColor: [200, 200, 200] // Color gris claro para las líneas
                },
                columnStyles: {
                    0: { cellWidth: 40 }, // Material de Herramienta
                    1: { cellWidth: 40 }, // Materia Prima
                    2: { cellWidth: 30 }, // Diámetro (mm)
                    3: { cellWidth: 30 }, // Número de Dientes
                    4: { cellWidth: 40 }, // Velocidad de Corte (m/min)
                    5: { cellWidth: 30 }, // RPM
                    6: { cellWidth: 40 }, // Avance de Corte
                    7: { cellWidth: 40 }, // Profundidad máxima de corte
                }
            });

            // Establecer pie de página con número de página
            doc.setFontSize(8);
            doc.setTextColor(150, 150, 150); // Color gris para el pie de página
            doc.text("Página " + doc.internal.getNumberOfPages(), doc.internal.pageSize.width - 30, doc.internal.pageSize.height - 20);

            // Descargar el archivo PDF
            doc.save('lista_de_operaciones_de_desbasteA.pdf');
        });
    </script>


{{-- Estilos --}}
<style>
    .btn-add-operation {
        background-color: #ffcc00;
        color: #444;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-add-operation:hover {
        background-color: #ffdd44;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: #ffe680;
    }

    .btn-delete {
        background-color: #ff6666;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #ff4d4d;
    }
</style>
@endsection
