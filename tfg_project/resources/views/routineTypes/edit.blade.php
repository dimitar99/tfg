@extends('layouts.app')

@section('title', 'Editar Tipo Rutina')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar {{ $routineType->name }}</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url("/routineTypes/{$routineType->id}") }}">

                        @method('PUT')
                        {!! csrf_field() !!}
                        <div class="form">
                            <label for="name">Nombre: </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Pecho"
                                value="{{ old('name', $routineType->name) }}">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('routineTypes.list') }}" style="text-decoration: none">Volver</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
