@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <header class="text-center mb-5">
        <h2 class="display-4 animate__animated animate__fadeInDown">Bienvenido {{ Auth::user()->name }} al Panel de Administración</h2>
        <p class="lead animate__animated animate__fadeInUp">Gestiona usuarios, consulta reportes y ajusta configuraciones de forma rápida y eficiente.</p>
    </header>

    <!-- Action Cards Section -->
    <div class="row mt-5 text-center">
        <!-- Card: Usuarios -->
        <div class="col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInLeft">
            <div class="card shadow h-100">
                <div class="card-body text-dark">
                    <i class="fas fa-users fa-2x mb-2"></i>
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Administra y gestiona usuarios de forma segura.</p>
                    <a href="{{ url('/alumnos') }}" class="btn">Ir a Usuarios</a>
                </div>
            </div>
        </div>
        
        <!-- Card: Reportes -->
        <div class="col-lg-4 col-md-6 mb-4 animate__animated animate__fadeIn">
            <div class="card shadow h-100">
                <div class="card-body text-dark">
                    <i class="fas fa-chart-line fa-2x mb-2"></i>
                    <h5 class="card-title">Acabado</h5>
                    <p class="card-text">Gestiona y crea tus propias operaciones de acabado.</p>
                    <a href="{{ url('/acabados') }}" class="btn">Hacer operaciones</a>
                </div>
            </div>
        </div>
        
        <!-- Card: Configuración -->
        <div class="col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInRight">
            <div class="card shadow h-100" style="background-color: rgb(255, 255, 255);">
                <div class="card-body text-dark">
                    <i class="fas fa-cogs fa-2x mb-2"></i>
                    <h5 class="card-title">Desbaste</h5>
                    <p class="card-text">Gestiona y crea tus propias operaciones de desbaste.</p>
                    <a href="{{ url('/desbastes') }}" class="btn">Hacer operaciones</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information Section -->
    <section class="mt-5">
        <h3 class="text-center animate__animated animate__fadeInDown">Funciones Clave</h3>
        <p class="text-center animate__animated animate__fadeInUp">Accede a herramientas avanzadas para mejorar la gestión y control de tu sistema administrativo.</p>
        
        <div class="row mt-4 text-center">
            <!-- Función Clave: Seguridad Avanzada -->
            <div class="col-md-4 mb-4 animate__animated animate__zoomIn">
                <div class="card shadow h-100" style="background-color: rgb(255, 255, 255);">
                    <div class="card-body text-dark">
                        <h5>Seguridad Avanzada</h5>
                        <p>Garantiza la protección de la información de tus alumnos, evitando su uso indebido y asegurando la máxima confidencialidad con nuestro programa.</p>
                    </div>
                </div>
            </div>
            
            <!-- Función Clave: Análisis de Datos -->
            <div class="col-md-4 mb-4 animate__animated animate__zoomIn">
                <div class="card shadow h-100" style="background-color: rgb(255, 255, 255);">
                    <div class="card-body text-dark">
                        <h5>Creación de Operaciones</h5>
                        <p>Obtén resultados precisos para procesos de acabado y desbaste con nuestra solución avanzada.</p>
                    </div>
                </div>
            </div>
            
            <!-- Función Clave: Soporte Técnico -->
            <div class="col-md-4 mb-4 animate__animated animate__zoomIn">
                <div class="card shadow h-100" style="background-color: rgb(255, 255, 255);">
                    <div class="card-body text-dark">
                        
                        <h5>Soporte Técnico</h5>
                        <p>Asistencia técnica disponible las 24 horas para garantizar el óptimo funcionamiento de tu sistema.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Custom CSS for Responsive Design and Animations -->
<style>
    /* Card Hover and Animation Effects */
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .card{
        border-color: #FFC107;
        border-width: 3px; /* Cambia el valor a tu preferencia */
        border-style: solid; /* Asegúrate de especificar un estilo de borde */
    }
    .btn{
        background: #FFC107;
        border-radius: 15px;
    }
    /* Header Image Styling */
    header img {
        max-width: 80%;
        border-radius: 15px;
        transition: transform 0.3s ease;
    }
    
    header img:hover {
        transform: scale(1.02);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        header h2, header p {
            font-size: 1.5rem;
        }
        
        .card .fas {
            font-size: 1.5rem;
        }
    }
</style>
@endsection
