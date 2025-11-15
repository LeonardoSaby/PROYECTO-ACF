@extends('adminlte::page')

@section('template_title')
    {{ $infante->nombre_infante ?? __('Detalles') . " " . __('Infante') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            {{-- Card Infante --}}
            <div class="card shadow-sm rounded-lg mb-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">{{ __('Detalles del Infante') }}</h3>
                    <a class="btn btn-light btn-sm" href="{{ route('infantes.index') }}">Volver</a>
                </div>

                <div class="card-body bg-white">
                    <div class="row">
                        <div class="col-md-6 mb-2"><strong>Nombre:</strong> {{ $infante->nombre_infante }}</div>
                        <div class="col-md-6 mb-2"><strong>Apellido:</strong> {{ $infante->apellido_infante }}</div>
                        <div class="col-md-6 mb-2"><strong>CI:</strong> {{ $infante->CI_infante }}</div>
                        <div class="col-md-6 mb-2"><strong>Fecha Nacimiento:</strong> {{ $infante->fecha_nacimiento_infante }}</div>
                        <div class="col-md-6 mb-2"><strong>Género:</strong> {{ $infante->genero_infante }}</div>
                        <div class="col-md-6 mb-2"><strong>Estado:</strong> {{ $infante->estado }}</div>
                    </div>
                </div>
            </div>

            {{-- Card Tutores --}}
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-gradient-secondary text-white">
                    <h4 class="card-title mb-0">{{ __('Tutores Asignados') }}</h4>
                </div>
                <div class="card-body">
                    
                        <div class="row">
                            @foreach($infante->tutores as $tutor)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-info shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $tutor->nombre_tutor }} {{ $tutor->apellido_tutor }}
                                                @if($tutor->pivot->estado === 'activo')
                                                    <span class="badge bg-success">A Cargo</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactivo</span>
                                                @endif
                                            </h5>
                                            <p class="card-text">
                                                <strong>Parentesco:</strong> {{ $tutor->pivot->parentesco }}<br>
                                                <strong>Estado Pivote:</strong> {{ $tutor->pivot->estado }}<br>
                                                <strong>ID Pivote:</strong> {{ $tutor->pivot->infante_tutor_id }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
