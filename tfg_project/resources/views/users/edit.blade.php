@extends('layouts.app')

@section('title', __('tfg.users.edit'))

@section('page_title', __('tfg.users.title'))

@section('current_breadcrumb', __('tfg.users.edit'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ __('tfg.users.edit') }} <strong>{{ '@' . $user->nick }}</strong></div>

                    <div class="card-body">

                        @include('shared._errors')

                        <form method="POST" action="{{ url("/users/{$user->id}") }}" enctype="multipart/form-data">

                            @method('PUT')
                            @include('shared._userFields')

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-info"> {{ __('tfg.buttons.update') }} </button>
                                <a href="{{ route('users.list') }}" style="text-decoration: none">
                                    {{ __('tfg.buttons.return') }} </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_scripts')
    <script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });

    </script>
@endsection
