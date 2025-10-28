@extends('adminlte::page')

@section('template_title')
    {{ $nivele->name ?? __('Show') . " " . __('Nivele') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Nivele</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('niveles.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Nivel:</strong>
                                    {{ $nivele->nombre_nivel }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Edad Minima:</strong>
                                    {{ $nivele->edad_minima }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Edad Maxima:</strong>
                                    {{ $nivele->edad_maxima }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $nivele->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
