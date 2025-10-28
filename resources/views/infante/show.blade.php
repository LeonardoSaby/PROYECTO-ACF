@extends('adminlte::page')

@section('template_title')
    {{ $infante->name ?? __('Show') . " " . __('Infante') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Infante</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('infantes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Infante:</strong>
                                    {{ $infante->nombre_infante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido Infante:</strong>
                                    {{ $infante->apellido_infante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ci Infante:</strong>
                                    {{ $infante->CI_infante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Nacimiento Infante:</strong>
                                    {{ $infante->fecha_nacimiento_infante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Edad Infante:</strong>
                                    {{ $infante->edad_infante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Genero Infante:</strong>
                                    {{ $infante->genero_infante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $infante->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
