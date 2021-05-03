@extends('layouts.app')

@section('title', __('tfg.users.create'))

@section('page_title', __('tfg.users.title'))

@section('current_breadcrumb', __('tfg.users.create'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('tfg.users.new') }}</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url('/users/create') }}" enctype="multipart/form-data">

                        @include('shared._userFields')

                        <div class="form-group">
                            <label for="avatar">Avatar: </label> <small>({{ __('tfg.forms.small.avatar_info') }})</small>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>
                        <br>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-info">{{ __('tfg.users.create') }}</button>
                            <a href="{{ route('users.list') }}" style="text-decoration: none">{{ __('tfg.buttons.return') }}</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
