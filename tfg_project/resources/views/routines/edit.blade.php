@extends('layouts.app')

@section('title', 'Editar Rutina')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ __('tfg.buttons.edit') }} {{ $routine->name }}</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url("/routines/{$routine->id}") }}">

                        @method('PUT')
                        @include('shared._routineFields')

                        @if($image != "")
                            <img src="{{ $image }}" alt="Imagen de la rutina" width="200px" height="200px">
                        @endif

                        <div class="form-group">
                            <label for="image">{{ __('tfg.forms.fields.image') }}: </label> <small>({{ __('tfg.forms.small.avatar_info') }})</small>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary"> {{ __('tfg.buttons.update') }}</button>
                            <a href="{{ route('routines.list') }}" style="text-decoration: none"> {{ __('tfg.buttons.return') }} </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
