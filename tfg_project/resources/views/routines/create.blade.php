@extends('layouts.app')

@section('title', __('tfg.routines.create'))

@section('page_title', __('tfg.routines.title'))

@section('current_breadcrumb', __('tfg.routines.create'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('tfg.routines.new') }}</div>

                    <div class="card-body">

                        @include('shared._errors')

                        <form method="POST" action="{{ url('/routines/create') }}" enctype="multipart/form-data">

                            @include('shared._routineFields')

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-info">{{ __('tfg.routines.create') }}</button>
                                <a href="{{ route('routines.list') }}"
                                    style="text-decoration: none">{{ __('tfg.buttons.return') }}</a>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
