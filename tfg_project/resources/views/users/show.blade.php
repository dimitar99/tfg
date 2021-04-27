@extends('layouts.app')

@section('title', 'Usuario')

@section('content')
<div class="container">
    <a href="{{ route('users.list') }}" class="btn btn-outline-dark btn-sm">{{ __('tfg.buttons.return-to-list') }}</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('tfg.users.detail') }} {{ $user->nick }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        @if($avatar != "")
                            <img src="{{ $avatar }}" alt="Avatar de usuario" width="100px" height="100px">
                        @endif

                        <p><strong>{{ __('tfg.forms.fields.id') }}: </strong>{{ $user->id }}</p>
                        <p><strong>{{ __('tfg.forms.fields.name') }}: </strong>{{ $user->name }}</p>
                        <p><strong>{{ __('tfg.forms.fields.surnames') }}: </strong>{{ $user->surnames }}</p>
                        <p><strong>{{ __('tfg.forms.fields.nick') }}: </strong>{{ $user->nick }}</p>
                        <p><strong>{{ __('tfg.forms.fields.bio') }}: </strong>{{ $user->bio }}</p>
                        <p><strong>{{ __('tfg.forms.fields.email') }}: </strong>{{ $user->email }}</p>
                        <p><strong>{{ __('tfg.forms.fields.num-posts') }}: </strong>{{ $user->posts->count()}}</p>
                        <p><strong>{{ __('tfg.forms.fields.followers') }}: </strong>{{ $user->followers->count() }}</p>
                        <p><strong>{{ __('tfg.forms.fields.followed') }}: </strong>{{ $user->followed->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
