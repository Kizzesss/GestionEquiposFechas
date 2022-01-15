@extends('layouts.app')

@section('template_title')
    Prestamo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Prestamo') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('prestamos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Equipo Id</th>
										<th>Usuario</th>
										<th>Estado</th>
										<th>Fecha Inicio</th>
										<th>Fecha Fin</th>
										<th>Fecha Fentrega</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamos as $prestamo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $prestamo->equipo_id }}</td>
											<td>{{ $prestamo->usuario }}</td>
											<td>{{ $prestamo->estado }}</td>
											<td>{{ $prestamo->fecha_inicio }}</td>
											<td>{{ $prestamo->fecha_fin }}</td>
											<td>{{ $prestamo->fecha_fentrega }}</td>

                                            <td>
                                                <form action="{{ route('prestamos.destroy',$prestamo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('prestamos.show',$prestamo->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('prestamos.edit',$prestamo->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $prestamos->links() !!}
            </div>
        </div>
    </div>

    <hr>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between;">
                            
                            <form action="{{ route('prestamos.index') }}" method="POST">
                                @csrf
                                <div class="col mt-2">
                                    <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                                </div>
    
                                <div class="col mt-2">
                                    <label for="fechaFin" class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                </div>
    
                                <button type="submit" class="btn btn-info btn-sm"> Filtrar </button>
                            </form>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
										<th>Equipo Id</th>
										<th>Usuario</th>
										<th>Multa</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamos as $prestamo)
                                        <tr>  

											<td>{{ $prestamo->equipo_id }}</td>
											<td>{{ $prestamo->usuario }}</td>
                                            <td></td>  

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $prestamos->links() !!}
            </div>
        </div>
    </div>
@endsection
