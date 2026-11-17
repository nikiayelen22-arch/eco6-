@extends('layouts.admin')

@section('title', 'Estudiantes')
@section('page-title', 'Inscripción de Gastronomía')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Estudiantes registrados</h3>
        <div class="card-tools">
            <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nuevo ingresante
            </a>
        </div>
    </div>

    <div class="card-body">
        @if($estudiantes->count())
            <div class="table-responsive">
                <table id="tabla-estudiantes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Edad</th>
                            <th>Carrera</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->id }}</td>
                                <td>{{ $estudiante->nombre }}</td>
                                <td>{{ $estudiante->apellido }}</td>
                                <td>{{ $estudiante->email }}</td>
                                <td>{{ $estudiante->edad ?? 'N/A' }}</td>
                                <td>{{ $estudiante->carrera }}</td>
                                <td>
                                    @if($estudiante->foto)
                                        <img src="{{ asset('storage/' . $estudiante->foto) }}"
                                             alt="Foto de {{ $estudiante->nombre }}"
                                             width="55" height="55"
                                             style="object-fit: cover; border-radius: 50%;">
                                    @else
                                        Sin foto
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('estudiantes.show', $estudiante->id) }}"
                                       class="btn btn-info btn-sm" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                                       class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}"
                                          method="POST" style="display:inline"
                                          onsubmit="return confirm('¿Eliminar este estudiante?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted mb-0">Todavía no hay estudiantes registrados.</p>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#tabla-estudiantes').DataTable({
            language: {
                search: 'Buscar:',
                lengthMenu: 'Mostrar _MENU_ registros',
                info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                infoEmpty: 'No hay registros para mostrar',
                zeroRecords: 'No se encontraron coincidencias',
                emptyTable: 'No hay estudiantes registrados',
                paginate: {
                    first: 'Primero',
                    last: 'Último',
                    next: 'Siguiente',
                    previous: 'Anterior'
                }
            }
        });
    });
</script>
@endpush
