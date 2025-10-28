@extends('adminlte::page')

@section('template_title')
    Inscripciones
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Administrar Inscripciones') }}
                            </span>

                            <form action="{{ route('inscripciones.index') }}" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control form-control-sm mr-2"
                                placeholder="Buscar..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-secondary">Buscar</button>
                        </form>

                             <div class="float-right">
                                 <a href="{{ route('inscripciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                     {{ __('Registrar Inscripcion') }}
                                 </a>
                             </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                        
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                    
                                        <th >Infante</th>
                                        <th >Curso</th>
                                        <th >Turno</th>
                                        <th >Fecha de registro</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscripciones as $inscripcione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td >{{ $inscripcione->infante->nombre_infante .' '.$inscripcione->infante->apellido_infante }}</td>
                                            
                                            {{-- USAR ESTA LÍNEA ES CRUCIAL PARA LA SEGURIDAD Y LA LECTURA DE DATOS --}}
                                            <td >{{ $inscripcione->curso?->nombre_curso ?? 'Sin curso asignado' }}</td> 
                                            
                                            <td >{{ $inscripcione->turno->nombre_turno }}</td>
                                            <td >{{ $inscripcione->fecha }}</td>

                                                <td>
                                                    <form action="{{ route('inscripciones.destroy', $inscripcione->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-success" href="{{ route('inscripciones.edit', $inscripcione->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- Se reemplaza confirm() por un manejo personalizado para evitar el uso de funciones bloqueantes --}}
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); if(confirm('¿Estás seguro de que quieres eliminar esta inscripción?')) { this.closest('form').submit(); }"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    </form>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
