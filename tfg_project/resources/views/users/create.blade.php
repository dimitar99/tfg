@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear nuevo usuario</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url('/users/create') }}">

                        @include('shared._userFields')

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Crear usuario</button>
                            <a href="{{ route('users.index') }}" style="text-decoration: none">Volver</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
