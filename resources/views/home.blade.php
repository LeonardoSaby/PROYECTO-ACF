@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1 class="text-success"><i class="fas fa-child"></i> ¡Bienvenido!</h1>
@stop

@section('content')

    {{-- Tarjeta Principal de Bienvenida --}}
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-hand-holding-heart mr-1"></i>
                Nuestro Rincón Feliz
            </h3>
        </div>
        <div class="card-body">
            <p>¡Qué alegría tenerte aquí!
                <br> Este es tu espacio para mantenerte al día con el bienestar y los hitos de nuestros pequeños.</p>
            <p class="text-muted m-0">
                <i class="fas fa-smile"></i> ¡Estamos listos para un día lleno de juegos y aprendizajes!
            </p>
        </div>
    </div>
    
    {{-- Info Boxes Temáticos --}}
    <div class="row">
        <!--
        {{-- Info Box 1: Niños Presentes --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon elevation-1"><i class="fas fa-baby"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Niños Presentes Hoy</span>
                    <span class="info-box-number">28 / 30</span>
                </div>
            </div>
        </div>
        
        {{-- Info Box 2: Próximo Evento (Yellow/Warning) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-gradient-warning mb-3">
                <span class="info-box-icon elevation-1"><i class="fas fa-birthday-cake"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Próximo Cumpleaños</span>
                    <span class="info-box-number">Mateo (Mañana)</span>
                </div>
            </div>
        </div>
    -->

        
    </div>
    {{-- End Content Row --}}

@stop

@section('css')
    {{-- Opcional: Si deseas agregar algún estilo particular --}}
@stop

@section('js')
    <script> console.log('¡Hola! El panel de la guardería está listo para ser explorado.'); </script>
@stop