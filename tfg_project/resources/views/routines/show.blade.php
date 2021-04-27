@extends('layouts.app')

@section('title', 'Rutina')

@section('content')
<div class="container">
    <a href="{{ route('routines.list') }}" class="btn btn-outline-dark btn-sm">Regresar al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('tfg.routines.detail') }} {{ $routine->name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>{{ __('tfg.forms.fields.id') }}: </strong>{{ $routine->id }}</p>
                        <p><strong>{{ __('tfg.forms.fields.name') }}: </strong>{{ $routine->name }}</p>
                        <p><strong>{{ __('tfg.forms.fields.type') }}: </strong>{{ $routine->type }}</p>
                        <p><strong>{{ __('tfg.forms.fields.description') }}: </strong>{{ $routine->description }}</p>
                        <p><strong>{{ __('tfg.forms.fields.image') }}: </strong>{{ $routine->image }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
