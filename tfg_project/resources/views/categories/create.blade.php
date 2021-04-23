@extends('layouts.app')

@section('title', 'Crear Categoria')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear nueva categoria</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url('/categories/create') }}">

                        {!! csrf_field() !!}
                        <div class="form">
                            <label for="name">Nombre: </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Escalada"
                                value="{{ old('name', $category->name) }}">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Crear categoria</button>
                            <a href="{{ route('categories.list') }}" style="text-decoration: none">Volver</a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
