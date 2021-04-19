@extends('layouts.app')

@section('title', 'Usuario')

@section('content')
<div class="container">
    <a href="{{ route('users.list') }}" class="btn btn-outline-dark btn-sm">Regresar al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detalle de {{ $user->name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        @if($avatar != "")
                            <img src="{{ $avatar }}" alt="Avatar de usuario" width="100px" height="100px">
                        @endif

                        <p><strong>Id: </strong>{{ $user->id }}</p>
                        <p><strong>Nombre: </strong>{{ $user->name }}</p>
                        <p><strong>Apellidos: </strong>{{ $user->surnames }}</p>
                        <p><strong>Nick: </strong>{{ $user->nick }}</p>
                        <p><strong>Bio: </strong>{{ $user->bio }}</p>
                        <p><strong>Email: </strong>{{ $user->email }}</p>
                        <p><strong>Num Posts: </strong>00000</p>
                        <p><strong>Seguidores: </strong>{{ $user->followers }}</p>
                        <p><strong>Seguidos: </strong>{{ $user->followed }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
