@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ __('tfg.buttons.edit') }} {{ $category->name }}</div>

                    <div class="card-body">

                        @include('shared._errors')

                        <form method="POST" action="{{ url("/categories/{$category->id}") }}">

                            @method('PUT')
                            {!! csrf_field() !!}
                            <div class="form">
                                <label for="name"> {{ __('tfg.forms.fields.name') }}: </label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $category->name) }}">
                            </div>
                            <br>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary"> {{ __('tfg.buttons.update') }} </button>
                                <a href="{{ route('categories.list') }}" style="text-decoration: none"> {{ __('tfg.buttons.return') }} </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
