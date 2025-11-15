@extends('adminlte::page')

@section('template_title')
    {{ $docente->nombre_docente ?? __('Show') . " " . __('Docente') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Card principal --}}
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fas fa-chalkboard-teacher"></i> Datos del Docente</h3>
                    <a class="btn btn-light btn-sm" href="{{ route('docentes.index') }}">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body bg-light p-4">

                    {{-- Info Boxes --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-info shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-user"></i> Nombre</h5>
                                    <p class="card-text">{{ $docente->nombre_docente }} {{ $docente->apellido_docente }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-warning shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-id-card"></i> CI</h5>
                                    <p class="card-text">{{ $docente->CI_docente }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-success shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-phone"></i> Teléfono</h5>
                                    <p class="card-text">{{ $docente->telefono_docente }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-primary shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-envelope"></i> Correo</h5>
                                    <p class="card-text">{{ $docente->correo_electronico_docente }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-secondary shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-calendar-alt"></i> Fecha Contratación</h5>
                                    <p class="card-text">{{ $docente->fecha_contratacion }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card border-info shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-book"></i> Curso Asignado</h5>
                                    <p class="card-text">{{ $docente->curso->nombre_curso }}</p>
                                </div>
                            </div>
                        </div>
                    </div> {{-- row --}}

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
