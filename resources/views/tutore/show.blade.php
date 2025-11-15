@extends('adminlte::page')

@section('template_title')
    {{ $tutore->nombre_tutor ?? __('Tutor') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Card principal del tutor --}}
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fas fa-user"></i> Información del Tutor</h3>
                    <a class="btn btn-light btn-sm" href="{{ route('tutores.index') }}">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body bg-light p-4">
                    <div class="row g-3">

                        {{-- Nombre y Apellido --}}
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm">
                                <strong><i class="fas fa-id-badge me-1"></i> Nombre:</strong>
                                <p class="mb-0">{{ $tutore->nombre_tutor }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm">
                                <strong><i class="fas fa-id-badge me-1"></i> Apellido:</strong>
                                <p class="mb-0">{{ $tutore->apellido_tutor }}</p>
                            </div>
                        </div>

                        {{-- CI, Teléfono y Correo --}}
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded shadow-sm">
                                <strong><i class="fas fa-address-card me-1"></i> CI:</strong>
                                <p class="mb-0">{{ $tutore->CI_tutor }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded shadow-sm">
                                <strong><i class="fas fa-phone me-1"></i> Teléfono:</strong>
                                <p class="mb-0">{{ $tutore->telefono_tutor }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded shadow-sm">
                                <strong><i class="fas fa-envelope me-1"></i> Correo:</strong>
                                <p class="mb-0">{{ $tutore->correo_electronico_tutor }}</p>
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="col-12">
                            <div class="p-3 bg-white rounded shadow-sm d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fas fa-map-marker-alt me-1"></i> Dirección:</strong>
                                    <p class="mb-0">{{ $tutore->direccion_tutor }}</p>
                                </div>
                                <div>
                                    <strong><i class="fas fa-toggle-on me-1"></i> Estado:</strong>
                                    @if($tutore->estado == 'activo')
                                        <span class="badge bg-success">{{ ucfirst($tutore->estado) }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($tutore->estado) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
