@extends('layouts.app')

@section('title', 'Tipo Rutina')

@section('content')
<div class="container">
    <a href="{{ route('routineTypes.list') }}" class="btn btn-outline-dark btn-sm">Regresar al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('tfg.routines-types.detail') }} {{ $routineType->name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>{{ __('tfg.forms.fields.id') }}: </strong>{{ $routineType->id }}</p>
                        <p><strong>{{ __('tfg.forms.fields.name') }}: </strong>{{ $routineType->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
