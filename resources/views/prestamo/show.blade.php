@extends('layouts.app')

@section('template_title')
    {{ $prestamo->name ?? 'Show Prestamo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Prestamo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('prestamos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Equipo Id:</strong>
                            {{ $prestamo->equipo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $prestamo->usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Inicio:</strong>
                            {{ $prestamo->fecha_inicio }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Fin:</strong>
                            {{ $prestamo->fecha_fin }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Fentrega:</strong>
                            {{ $prestamo->fecha_fentrega }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
