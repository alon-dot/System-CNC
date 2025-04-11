@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="color: #444;">Lista de Operaciones de Acabado</h2>

    {{-- Botón para agregar una nueva operación --}}
    <div class="mb-3 text-center">
        <a href="{{ route('acabadols.create') }}" class="btn btn-add-operation">
            {{ __('+ Nueva Operación de Acabado') }}
        </a>
    </div>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('acabadols.index') }}" method="GET">
        <div class="mb-3 d-flex">
            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar" value="{{ request('search') }}">
        </div>
    </form>

    <!-- Botón para descargar PDF -->
    <button id="download-pdf" class="btn btn-success mb-4">Descargar PDF</button>

    {{-- Contenedor de la tabla responsiva --}}
    <div class="table-responsive" id="acabados-table">
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

    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $acabadols->links() }}
    </div>

</div>

<!-- SweetAlert2 script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Buscador en tiempo real con AJAX
    document.getElementById('search').addEventListener('keyup', function() {
        let search = this.value;

        // Realizar solicitud AJAX al servidor
        fetch(`{{ route('acabadols.index') }}?search=${search}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            // Actualizar la tabla con los nuevos datos
            document.getElementById('acabados-table').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });

    // Confirmar eliminación con SweetAlert2
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.js"></script>
<script>
document.getElementById('download-pdf').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    // Definir tamaño personalizado (300mm x 300mm)
    const doc = new jsPDF('p', 'mm', [300, 300]); // Tamaño más grande (300mm x 300mm)
    
    // Establecer fuentes
    doc.setFont("Helvetica", "normal");
    doc.setFontSize(14); // Tamaño de fuente para el título

    // Agregar logo institucional (opcional)
    const logoUrl = 'https://i.ibb.co/52Q5sn1/logo.jpg'; // Asegúrate de poner el URL correcto o usar base64
    doc.addImage(logoUrl, 'PNG', 10, 10, 25, 25); // Ajustar tamaño y posición del logo

    // Título centrado con color institucional
    doc.setTextColor(0, 51, 102); // Color institucional (azul oscuro)
    const title = "Lista de Operaciones de Acabado";
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
        "Avance de Corte"
    ];

    const data = Array.from(document.querySelectorAll('#acabados-table tbody tr')).map(row => {
        return Array.from(row.querySelectorAll('td')).slice(0, 7).map(cell => cell.textContent);
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
        }
    });

    // Establecer pie de página con número de página
    doc.setFontSize(8);
    doc.setTextColor(150, 150, 150); // Color gris para el pie de página
    doc.text("Página " + doc.internal.getNumberOfPages(), doc.internal.pageSize.width - 30, doc.internal.pageSize.height - 20);

    // Descargar el archivo PDF
    doc.save('lista_de_operaciones_de_acabadoA.pdf');
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
