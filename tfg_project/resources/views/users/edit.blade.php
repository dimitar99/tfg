@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar {{ $user->name }}</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url("/users/{$user->id}") }}" enctype="multipart/form-data">

                        @method('PUT')
                        @include('shared._userFields')

                        @if($avatar != "")
                            <img src="{{ $avatar }}" alt="Avatar de usuario" width="200px" height="200px">
                        @endif

                        <div class="form-group">
                            <label for="avatar">Avatar: </label> <small>(Solo formato .jpg)</small>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('users.list') }}" style="text-decoration: none">Volver</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
