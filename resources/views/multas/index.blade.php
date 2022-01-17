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
                        <div style="display: flex; justify-content: space-between;">
                            
                            <form action="{{ route('multas.index') }}" method="POST">
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
                                            <td>{{ $multas }}</td>  

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