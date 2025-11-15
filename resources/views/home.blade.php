@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-home"></i> Panel de la Guardería</h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Primera fila: Niños inscritos y próximo cumpleaños --}}
    <div class="row g-3">
        <div class="col-md-6">
            <div class="info-box bg-gradient-primary shadow-sm">
                <span class="info-box-icon"><i class="fas fa-baby"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Niños Inscritos</span>
                    <span class="info-box-number">{{ $totalInfantes }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-box bg-gradient-info shadow-sm">
                <span class="info-box-icon"><i class="fas fa-birthday-cake"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Próximo Cumpleaños</span>
                    <span class="info-box-number">
                        {{ $proximoCumple ? $proximoCumple->nombre_infante . ' ' . $proximoCumple->apellido_infante . ' (' . \Carbon\Carbon::parse($proximoCumple->fecha_nacimiento_infante)->format('d M') . ')' : 'Ninguno cercano' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

{{-- Segunda fila: Diagramas de estadísticas --}}
<div class="row g-3 mt-3">
    {{-- Asistencia Hoy --}}
    <div class="col-md-6">
        <div class="card shadow-sm p-3 text-center">
            <h5 class="text-primary">Asistencia Hoy</h5>
            <canvas id="asistenciaChart" height="180" style="max-width: 300px; margin: 0 auto;"></canvas>
            <p class="text-center mt-2">
                {{ $presentesHoy }} presentes de {{ $totalInfantes }} inscritos
            </p>
        </div>
    </div>

    {{-- Distribución de Edades --}}
    <div class="col-md-6">
        <div class="card shadow-sm p-3 text-center">
            <h5 class="text-primary">Distribución de Edades</h5>
            <canvas id="edadesChart" height="180" style="max-width: 400px; margin: 0 auto;"></canvas>
        </div>
    </div>
</div>



    {{-- Tercera fila: Mensaje de bienvenida --}}
    <div class="row g-3 mt-3">
        <div class="col-md-12">
            <div class="card bg-gradient-info text-white p-4 text-center rounded-4 shadow">
                <h4>¡Bienvenidos al día lleno de diversión y aprendizaje!</h4>
            </div>
        </div>
    </div>

    {{-- Cuarta fila: Tip del día --}}
    <div class="row g-3 mt-3">
        <div class="col-md-12">
            <div class="card shadow-sm rounded-4 p-3 bg-light border-start border-5 border-primary">
                <h5 class="text-primary">Tip del Día:</h5>
                @php
                    $frases = [
                        "Hoy un abrazo hace la diferencia",
                        "El aprendizaje es más divertido jugando",
                        "Recuerda hidratar a los pequeños durante el recreo",
                        "Una sonrisa contagia alegría a todos",
                    ];
                    $frase = $frases[array_rand($frases)];
                @endphp
                <p class="mb-0">{{ $frase }}</p>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-5 text-muted small">
        Guardería Asociación Cristiana Femenina - Cuidando con amor cada día
    </div>

</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Asistencia
    const ctxAsistencia = document.getElementById('asistenciaChart').getContext('2d');
    new Chart(ctxAsistencia, {
        type: 'doughnut',
        data: {
            labels: ['Presentes', 'Ausentes'],
            datasets: [{
                data: [{{ $porcentajeAsistencia }}, {{ $porcentajeAusencia }}],
                backgroundColor: ['#6CAFD9', '#034C8C'], // azul claro y azul fuerte
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Gráfico de Distribución de Edades
    const ctxEdades = document.getElementById('edadesChart').getContext('2d');
    new Chart(ctxEdades, {
        type: 'bar',
        data: {
            labels: {!! json_encode($edades->keys()) !!},
            datasets: [{
                label: 'Cantidad de Niños',
                data: {!! json_encode($edades->values()) !!},
                backgroundColor: ['#6CAFD9', '#034C8C'], // colores consistentes con la paleta
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, precision: 0 } }
        }
    });
</script>
@stop
