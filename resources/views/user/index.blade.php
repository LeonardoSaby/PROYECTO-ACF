@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid">
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Registrar Usuario</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @forelse($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @empty
                        <span class="text-muted">Sin rol</span>
                    @endforelse

                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm">Editar</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro que desea eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users->links() !!}
</div>
@endsection
