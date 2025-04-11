@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="color: #444;">Lista de Alumnos</h2>

    <div class="mb-3 text-center">
        <a href="{{ route('alumnos.create') }}" class="btn btn-add-operation">
            {{ __('+ Agregar Nuevo Alumno') }}
        </a>
    </div>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('alumnos.index') }}" method="GET">
        <div class="mb-3 d-flex">
            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar por matrícula" value="{{ request('search') }}">
        </div>
    </form>

    <!-- Botón para descargar PDF -->
    <button id="download-pdf" class="btn btn-success mb-4">Descargar PDF</button>

    <!-- Contenedor de la tabla responsiva -->
    <div class="table-responsive">
        <table id="alumnos-table" class="table table-hover shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <thead style="background-color: #444; color: white;">
                <tr>
                    <th>No.</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Matrícula</th>
                    <th>Cuatrimestre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr style="background-color: #f8f8f8;">
                        <td>{{ ++$i }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->usuario }}</td>
                        <td>{{ $alumno->matricula }}</td>
                        <td>{{ $alumno->cuatrimestre }}</td>
                        <td>
                            <div class="d-inline-flex">
                                <a class="btn btn-sm btn-info mr-1" href="{{ route('alumnos.show', $alumno->id) }}">
                                    <i class="fa fa-fw fa-eye"></i> Ver
                                </a>
                                <a class="btn btn-sm btn-success mr-1" href="{{ route('alumnos.edit', $alumno->id) }}">
                                    <i class="fa fa-fw fa-edit"></i> Editar
                                </a>
                                <form id="delete-form-{{ $alumno->id }}" action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteAlumno({{ $alumno->id }})">
                                        <i class="fa fa-fw fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $alumnos->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.js"></script>

<script>
// Confirmación de eliminación con SweetAlert2
function deleteAlumno(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Este alumno será eliminado permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar el formulario para eliminar el alumno
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

// Descargar tabla como PDF
document.getElementById('download-pdf').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'mm', 'a4');

    doc.setFont("Helvetica", "normal");
    doc.setFontSize(14); 
    doc.setTextColor(255, 193, 7);
    doc.text("Lista de Alumnos", doc.internal.pageSize.width / 2, 30, { align: 'center' });

    const logoUrl = 'https://i.ibb.co/52Q5sn1/logo.jpg'; 
    doc.addImage(logoUrl, 'PNG', 10, 10, 25, 25); 

    const currentDate = new Date();
    const dateString = currentDate.toLocaleDateString();
    const timeString = currentDate.toLocaleTimeString();
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.text("Fecha de descarga: " + dateString, 14, 40);
    doc.text("Hora de descarga: " + timeString, 14, 50);
















    const columns = ["No", "Nombre", "Usuario", "Matrícula", "Cuatrimestre"];
    const data = Array.from(document.querySelectorAll('#alumnos-table tbody tr')).map(row => {
        return Array.from(row.querySelectorAll('td')).slice(0, 5).map(cell => cell.textContent);
    });

    doc.autoTable({
        headStyles: {
            fillColor: [255, 193, 7], // Color amarillo #ffc107 para el encabezado de la tabla
            textColor: [0, 0, 0], // Color negro para el texto del encabezado
        },
        head: [columns],
        body: data,
        startY: 60,
    });

    doc.save('lista_de_alumnos.pdf');
});
</script>



<script>
    // Buscador en tiempo real
document.getElementById('search').addEventListener('keyup', function() {
    let search = this.value.toLowerCase();
    let rows = document.querySelectorAll('#alumnos-table tbody tr');

    rows.forEach(row => {
        let cells = row.getElementsByTagName('td');
        let found = false;
        
        // Recorre las celdas, excepto la columna de acciones
        for (let i = 0; i < cells.length - 1; i++) { 
            if (cells[i].textContent.toLowerCase().includes(search)) {
                found = true;
                break;
            }
        }
        
        if (found) {
            row.style.display = ''; // Muestra la fila
        } else {
            row.style.display = 'none'; // Oculta la fila
        }
    });
});
    </script>

<style>
    
    /* Estilos personalizados */
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
    .btn-info {
        background-color: #17a2b8;
        color: white;
    }
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
</style>
@endsection
