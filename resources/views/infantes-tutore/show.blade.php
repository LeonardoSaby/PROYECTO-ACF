@extends('adminlte::page')

@section('template_title')
    {{ $infantesTutore->name ?? __('Show') . " " . __('Infantes Tutore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Infantes Tutore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('infantes-tutores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Infante Id:</strong>
                                    {{ $infantesTutore->infante_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tutor Id:</strong>
                                    {{ $infantesTutore->tutor_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Parentesco:</strong>
                                    {{ $infantesTutore->parentesco }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $infantesTutore->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
