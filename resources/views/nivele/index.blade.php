@extends('adminlte::page')

@section('template_title')
    Niveles
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Administrar Niveles') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('niveles.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                       

                                    <th >No</th> 
									<th >Nombre Nivel</th>
									<th >Edad Minima </th>
									<th >Edad Maxima</th>
									<th >Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($niveles as $nivele)
                                        <tr>
                                       
                                        <td >{{ ++$i }}</td>
										<td >{{ $nivele->nombre_nivel }}</td>
										<td >{{ $nivele->edad_minima . ' años'}}</td>
										<td >{{ $nivele->edad_maxima . ' años'}}</td>
										<td >{{ $nivele->estado }}</td>

                                            <td>
                                                <form action="{{ route('niveles.destroy', $nivele->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-primary " href="{{ route('niveles.show', $nivele->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>-->
                                                    <a class="btn btn-sm btn-success" href="{{ route('niveles.edit', $nivele->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
                {!! $niveles->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
