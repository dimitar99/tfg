@extends('layouts.app')

@section('title', 'Listado Usuarios')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('users.create') }}" class="btn btn-outline-dark">Nuevo usuario</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Listado usuarios') }}</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                              <th>Nombre</th>
                              <th>Apellidos</th>
                              <th>Nick</th>
                              <th>Email</th>
                              <th>Posts</th>
                              <th>Seguidos</th>
                              <th>Seguidores</th>
                              <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surnames}}</td>
                                    <td>{{$user->nick}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
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
