@extends('layouts.app')

@section('title', 'Listado Tipos Rutinas')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('routineTypes.create') }}" class="btn btn-outline-dark">Nuevo tipo rutina</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Listado Tipos Rutinas') }}</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($routineTypes as $routineType)
                                <tr>
                                    <td>{{$routineType->id}}</td>
                                    <td>{{$routineType->name}}</td>
                                    <td>
                                        <form action="{{ route('routineTypes.destroy', $routineType) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('routineTypes.show', $routineType) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                            <a href="{{ route('routineTypes.edit', $routineType) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
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
