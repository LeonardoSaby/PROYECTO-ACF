@extends('adminlte::page')

@section('template_title')
    {{ $tutore->name ?? __('Show') . " " . __('Tutore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Tutore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tutores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Tutor:</strong>
                                    {{ $tutore->nombre_tutor }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido Tutor:</strong>
                                    {{ $tutore->apellido_tutor }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ci Tutor:</strong>
                                    {{ $tutore->CI_tutor }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono Tutor:</strong>
                                    {{ $tutore->telefono_tutor }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo Electronico Tutor:</strong>
                                    {{ $tutore->correo_electronico_tutor }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Direccion Tutor:</strong>
                                    {{ $tutore->direccion_tutor }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $tutore->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
