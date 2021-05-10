@extends('layouts.app')

@section('title', __('tfg.users.detail'))

@section('page_title', __('tfg.users.title'))

@section('current_breadcrumb', __('tfg.users.detail'))

@section('content')
    <div class="container">
        <a href="{{ route('users.list') }}"
            class="btn btn-outline-dark btn-sm">{{ __('tfg.buttons.return-to-list') }}</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('tfg.users.detail') }} {{ "@" . $user->nick }}
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <img src="{{ $user->avatar }}" alt="Avatar de usuario" class="rounded mx-auto d-block" style="height: 300px; margin-bottom: 20px">
                            <p> {{ __('tfg.forms.fields.name') }} --> <strong>{{ $user->name }}</strong></p>
                            <p> {{ __('tfg.forms.fields.surnames') }} --> <strong>{{ $user->surnames }}</strong></p>
                            <p> {{ __('tfg.forms.fields.email') }} --> <strong>{{ $user->email }}</strong></p>
                            <p> {{ __('tfg.forms.fields.nick') }} --> <strong>{{ "@" . $user->nick }}</strong></p>
                            <p> {{ __('tfg.forms.fields.bio') }} --> <strong>{{ $user->bio }}</strong></p>
                            <p> {{ __('tfg.forms.fields.num-posts') }} --> <strong>{{ $user->posts->count() }}</strong></p>
                            <p> {{ __('tfg.forms.fields.followers') }} --> <strong>{{ $user->followers->count()}}</strong></p>
                            <p> {{ __('tfg.forms.fields.followed') }} --> <strong>{{ $user->followed->count() }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
