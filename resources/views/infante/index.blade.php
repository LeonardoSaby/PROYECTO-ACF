@extends('adminlte::page')

@section('template_title')
    Infantes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Administrar Infante') }}
                            </span>

                            <!-- Buscador -->
                        <form action="{{ route('infantes.index') }}" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control form-control-sm mr-2"
                                placeholder="Buscar infante..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-secondary">Buscar</button>
                        </form>

                             <div class="float-right">
                                <a href="{{ route('infantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar infantes') }}
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
                                        
									<th >Nombre</th>
									<th >Apellido</th>
									<th >CI</th>
									<th >Fecha Nacimiento</th>
									<th >Genero</th>
									<th >Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infantes as $infante)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $infante->nombre_infante }}</td>
										<td >{{ $infante->apellido_infante }}</td>
										<td >{{ $infante->CI_infante }}</td>
										<td >{{ $infante->fecha_nacimiento_infante }}</td>
										<td >{{ $infante->genero_infante }}</td>
										<td >{{ $infante->estado }}</td>

                                            <td>
                                                <form action="{{ route('infantes.destroy', $infante->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-primary " href="{{ route('infantes.show', $infante->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>-->
                                                    <a class="btn btn-sm btn-success" href="{{ route('infantes.edit', $infante->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Ecitar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
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
