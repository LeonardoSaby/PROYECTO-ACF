@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0"><i class="fas fa-user-shield"></i> Administrar Roles</h3>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Rol
                        </a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        {{-- Aplicamos una clase para aumentar el tamaño de la fuente de la tabla --}}
                        <table class="table table-striped table-hover table-bordered align-middle table-font-lg"> 
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Permisos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $index => $role)
                                    <tr>
                                        <td class="text-center">{{ $roles->firstItem() + $index }}</td>
                                        <td class="text-center">{{ $role->name }}</td>
                                        
                                        {{-- Alineación a la izquierda para facilitar la lectura --}}
                                        <td class="text-start">
                                            <div class="d-flex flex-wrap justify-content-start gap-1">
                                                @forelse ($role->permissions as $perm)
                                                    {{-- Añadimos la clase **permission-badge** para aumentar el tamaño de la fuente --}}
                                                    <span class="badge **permission-badge**" style="background-color: #d0e7ff; color: #0a3d62;">
                                                        {{ $perm->name . ','}}
                                                    </span>
                                                @empty
                                                    <span class="badge bg-secondary">Sin permisos</span>
                                                @endforelse
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a class="btn btn-sm btn-success" href="{{ route('roles.edit', $role->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); confirm('¿Seguro que desea eliminar este rol?') ? this.closest('form').submit() : false;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Sección CSS para los estilos personalizados --}}
@section('css')
    @section('css')
    <style>
        /* Estilo para los badges de permiso */
        .permission-badge {
            /* Aumentamos el tamaño de la fuente de los badges y forzamos su aplicación */
            font-size: 0.95em !important; 
            padding: 0.5em 0.8em !important;
            line-height: 1.2 !important; /* Para evitar que el texto esté muy pegado */
        }
        
        /* Estilo para aumentar el tamaño de la fuente de toda la tabla */
        .table-font-lg th,
        .table-font-lg td {
            /* Forzamos un tamaño de fuente más grande en toda la tabla */
            font-size: 1rem !important; 
            vertical-align: middle; /* Asegura que el contenido esté centrado verticalmente */
        }
        
        /* Ajuste para el texto en el encabezado (Administrar Roles) */
        .card-header h3 {
             font-size: 1.75rem !important; /* Hacemos el título más grande */
        }
        
        /* Aseguramos que el texto dentro de los botones de acción sea visible */
        .d-flex.justify-content-center.gap-1.flex-wrap .btn i {
             font-size: 0.9rem !important;
        }
        
    </style>
@endsection
@endsection