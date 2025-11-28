@extends('adminlte::page')

@section('template_title')
    Model Has Roles
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Administrar Roles de Usuario') }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('model-has-roles.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Registrar rol usuario') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <!-- Card Body -->
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Usuario</th>
                                    <th>Roles</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('model-has-roles.edit', $user->id) }}" class="btn btn-sm btn-success">
                                                <i class="fa fa-fw fa-edit"></i> Editar
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('model-has-roles.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Está seguro de eliminar todos los roles de este usuario?')">
                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
