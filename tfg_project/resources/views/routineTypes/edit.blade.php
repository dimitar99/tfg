@extends('layouts.app')

@section('title', __('tfg.routines-types.edit'))

@section('page_title', __('tfg.categories.title'))

@section('current_breadcrumb', __('tfg.routines-types.edit'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ __('tfg.routines-types.edit') }}</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url("/routineTypes/{$routineType->id}") }}">

                        @method('PUT')
                        {!! csrf_field() !!}
                        <div class="form">
                            <label for="name"> {{ __('tfg.forms.fields.name') }}: </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Pecho"
                                value="{{ old('name', $routineType->name) }}">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-info"> {{ __('tfg.buttons.update') }} </button>
                            <a href="{{ route('routineTypes.list') }}" style="text-decoration: none"> {{ __('tfg.buttons.return') }} </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
