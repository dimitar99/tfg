@extends('layouts.app')

@section('title', 'Rutina')

@section('content')
<div class="container">
    <a href="{{ route('routines.index') }}" class="btn btn-outline-dark btn-sm">Regresar al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detalle de {{ $routine->name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>Id: </strong>{{ $routine->id }}</p>
                        <p><strong>Nombre: </strong>{{ $routine->name }}</p>
                        <p><strong>Tipo: </strong>{{ $routine->type }}</p>
                        <p><strong>Video: </strong>{{ $routine->video }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
