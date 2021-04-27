@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ __('tfg.buttons.edit') }} {{ $user->name }}</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url("/users/{$user->id}") }}" enctype="multipart/form-data">

                        @method('PUT')
                        @include('shared._userFields')

                        @if($avatar != "")
                            <img src="{{ $avatar }}" alt="Avatar de usuario" width="200px" height="200px">
                        @endif

                        <div class="form-group">
                            <label for="avatar">Avatar: </label> <small>({{ __('tfg.forms.small.avatar_info') }})</small>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary"> {{ __('tfg.buttons.update') }} </button>
                            <a href="{{ route('users.list') }}" style="text-decoration: none"> {{ __('tfg.buttons.return') }} </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
