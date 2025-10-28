@extends('adminlte::page')

@section('template_title')
    {{ $docente->name ?? __('Show') . " " . __('Docente') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Docente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('docentes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Docente:</strong>
                                    {{ $docente->nombre_docente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido Docente:</strong>
                                    {{ $docente->apellido_docente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono Docente:</strong>
                                    {{ $docente->telefono_docente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ci Docente:</strong>
                                    {{ $docente->CI_docente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo Electronico Docente:</strong>
                                    {{ $docente->correo_electronico_docente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Contratacion:</strong>
                                    {{ $docente->fecha_contratacion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $docente->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
