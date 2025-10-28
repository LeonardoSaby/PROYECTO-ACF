@extends('adminlte::page')

@section('template_title')
    Infantes Tutores
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Infantes Tutores') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('infantes-tutores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar Infante y Tutor') }}
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
									<th >Tutor</th>
									<th >Parentesco</th>
									<th >Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infantesTutores as $infantesTutore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $infantesTutore->infante->nombre_infante .' '. $infantesTutore->infante->apellido_infante }}</td>
										<td >{{ $infantesTutore->tutore->nombre_tutor .' '. $infantesTutore->tutore->apellido_tutor }}</td>
										<td >{{ $infantesTutore->parentesco }}</td>
										<td >{{ $infantesTutore->estado }}</td>

                                            <td>
                                                <form action="{{ route('infantes-tutores.destroy', $infantesTutore->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-primary " href="{{ route('infantes-tutores.show', $infantesTutore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>-->
                                                    <a class="btn btn-sm btn-success" href="{{ route('infantes-tutores.edit', $infantesTutore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
                {!! $infantesTutores->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
