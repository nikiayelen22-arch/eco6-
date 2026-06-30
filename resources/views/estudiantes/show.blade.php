@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3><i class="fas fa-user"></i> Detalles del Estudiante</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID:</th>
                        <td>{{ $estudiante->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td>{{ $estudiante->nombre }}</td>
                    </tr>
                    <tr>
                        <th>Apellido:</th>
                        <td>{{ $estudiante->apellido }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $estudiante->email }}</td>
                    </tr>
                    <tr>
                        <th>Edad:</th>
                        <td>{{ $estudiante->edad ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                        <th>Carrera:</th>
                        <td>{{ $estudiante->carrera }}</td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td>{{ $estudiante->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td>{{ $estudiante->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="d-flex gap-2">
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection