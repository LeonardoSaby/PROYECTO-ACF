@extends('adminlte::page')

@section('template_title')
    {{ $sala->name ?? __('Show') . " " . __('Sala') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Sala</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('salas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Sala:</strong>
                                    {{ $sala->nombre_sala }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Capacidad Maxima:</strong>
                                    {{ $sala->capacidad_maxima }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $sala->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
