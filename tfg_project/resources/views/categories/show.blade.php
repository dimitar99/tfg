@extends('layouts.app')

@section('title', 'Categoria')

@section('content')
<div class="container">
    <a href="{{ route('categories.list') }}" class="btn btn-outline-dark btn-sm">Regresar al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detalle de {{ $category->name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>Id: </strong>{{ $category->id }}</p>
                        <p><strong>Nombre: </strong>{{ $category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
