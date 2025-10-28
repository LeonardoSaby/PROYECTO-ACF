@extends('adminlte::page')

@section('template_title')
    {{ $curso->name ?? __('Show') . " " . __('Curso') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Curso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cursos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Curso:</strong>
                                    {{ $curso->nombre_curso }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nivel Id:</strong>
                                    {{ $curso->nivel_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Sala Id:</strong>
                                    {{ $curso->sala_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Docente Id:</strong>
                                    {{ $curso->docente_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $curso->estado }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
