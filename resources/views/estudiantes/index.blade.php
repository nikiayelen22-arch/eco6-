@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Inscripción de Gastronomia </h1>
    <a href="{{ route('estudiantes.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nuevo ingresante 
    </a>
</div>

@if($estudiantes->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Carrera</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->id }}</td>
                <td>{{ $estudiante->nombre }}</td>
                <td>{{ $estudiante->apellido }}</td>
                <td>{{ $estudiante->email }}</td>
                <td>{{ $estudiante->edad ?? 'N/A' }}</td>
                <td>{{ $estudiante->carrera }}</td>
                <td>
                        <img src="{{ asset('storage/' . $estudiante->foto) }}" width="100">
                </td>
                <td>
                    <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Ver
                    </a>
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-info">
    No hay estudiantes registrados. <a href="{{ route('estudiantes.create') }}">¡Crea uno nuevo!</a>
</div>
@endif
@endsection