@extends('layouts.app')

@section('title', 'Listado Rutinas')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('routines.create') }}" class="btn btn-outline-dark">Nueva rutina</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Listado rutinas') }}</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                              <th>Nombre</th>
                              <th>Tipo</th>
                              <th>Descripcion</th>
                              <th>Video</th>
                              <th>Fecha Creacion</th>
                              <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($routines as $routine)
                                <tr>
                                    <td>{{$routine->name}}</td>
                                    <td>{{$routine->routineType->name}}</td>
                                    <td>{{$routine->description}}</td>
                                    <td>{{$routine->video}}</td>
                                    <td>{{ $routine->created_at }}</td>
                                    <td>
                                        <form action="{{ route('routines.destroy', $routine) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('routines.show', $routine) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                            <a href="{{ route('routines.edit', $routine) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
                                            <button type="submit">Eliminar</button>
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
@endsection
