@extends('layouts.app')

@section('content')

<div class="container-fluid" style="background-color: white; min-height: 100vh;">
    <div class="row justify-content-center pt-4">
        <div class="col-md-10">
            <div class="card">
                {{-- Encabezado --}}
                <div class="card-header bg-warning text-dark d-flex align-items-center justify-content-center position-relative">
                    <h3 class="mb-0">{{ __('Sistema de Operaciones CNC') }}</h3>
                </div>

                <div class="card-body text-center">
                    {{-- Mensaje de estado --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br><br>
                    <p>{{ __('Bienvenido al sistema de operaciones CNC. Aquí podrás gestionar y crear nuevas operaciones fácilmente. Explora las funcionalidades avanzadas para un mejor desempeño en la fabricación.') }}</p>
                    <br>

                    {{-- Sección de Información sobre CNC --}}
                    <div class="text-center mt-5">
                        <h4 class="text-warning">Introducción a las Operaciones CNC</h4>
                        <p>El CNC (Control Numérico por Computadora) es un sistema de automatización utilizado en la fabricación de piezas y componentes. En este sistema, las máquinas se controlan mediante códigos generados por computadora, lo que permite una mayor precisión y repetibilidad en los procesos.</p>
                    </div>

                    {{-- Funciones Avanzadas del Sistema --}}
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-6 mb-3">
                            <h5 class="text-warning">Operaciones de Desbaste</h5>
                            <p>En este tipo de operaciones, la máquina CNC remueve grandes cantidades de material para darle forma a la pieza. Es una fase crítica en el proceso de fabricación de componentes.</p>
                            <ul class="text-left">
                                <li>Uso de herramientas de corte robustas.</li>
                                <li>Control de la profundidad de corte para evitar deformaciones.</li>
                                <li>Optimización del tiempo de corte mediante programación eficiente.</li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="text-warning">Operaciones de Acabado</h5>
                            <p>El acabado es el proceso donde se realizan los detalles finos de la pieza, logrando una superficie lisa y precisa. Este proceso es esencial para la calidad del producto final.</p>
                            <ul class="text-left">
                                <li>Herramientas de precisión para cortes finos.</li>
                                <li>Parámetros de corte ajustados para evitar marcas de la herramienta.</li>
                                <li>Control del avance de la máquina para una textura perfecta.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Imágenes de CNC --}}
                    <div class="row text-center mt-4">
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mt-2">Operación de Desbaste en CNC</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mt-2">Proceso de Acabado CNC</p>
                        </div>
                    </div>

                    {{-- Ventajas de las Operaciones CNC --}}
                    <div class="text-center mt-5">
                        <h4 class="text-warning">Ventajas de las Operaciones CNC</h4>
                            <ul class="list-inline">
                                 <li class="list-inline-item">
                                    <span class="badge badge-warning" style="color: black;">Alta Precisión</span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="badge badge-warning" style="color: black;">Mayor Productividad</span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="badge badge-warning" style="color: black;">Reducción de Errores Humanos</span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="badge badge-secondary" style="color: black;">Menor Tiempo de Producción</span>
                                </li>
                                </ul>
                    </div>


                    {{-- Contenedor de Botones de Operaciones --}}
                    <div class="d-flex flex-column align-items-center mt-5">
                        <a href="{{ route('desbastels.create') }}" class="btn btn-warning btn-lg rounded-pill shadow mb-3" style="width: 250px;">
                            {{ __('+ Nueva Operación de Desbaste') }}
                        </a>
                        <a href="{{ route('acabadols.create') }}" class="btn btn-secondary btn-lg rounded-pill shadow" style="width: 250px;">
                            {{ __('+ Ir a Operaciones de Acabado') }}
                        </a>
                    </div>

                    {{-- Sección de Recursos y Descargas --}}
                    <div class="text-center mt-5">
                        <h4 class="text-warning">Recursos para Aprender Más</h4>
                        <p>Accede a material educativo para profundizar en las operaciones y técnicas CNC.</p>
                        <a href="path_to_manual.pdf" class="btn btn-warning rounded-pill mb-2">Descargar Manual Completo</a>
                        <a href="link_to_video_tutorial" class="btn btn-secondary rounded-pill">Ver Video Tutorial</a>
                    </div>

                    {{-- Texto con efecto de caída --}}
                    <div class="mt-5 falling-text">
                        <p>{{ __('¡Explora todas las funcionalidades y mejora tus habilidades en el uso de CNC!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Animaciones y estilos personalizados --}}
<style>
    .falling-text p {
        display: inline-block;
        animation: falling 2s infinite;
    }

    @keyframes falling {
        0% {
            transform: translateY(-100px);
            opacity: 0;
        }
        50% {
            transform: translateY(0);
            opacity: 1;
        }
        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }
</style>

@endsection
