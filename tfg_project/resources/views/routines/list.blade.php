@extends('layouts.app')

@section('title', __('tfg.routines.list'))

@section('page_title', __('tfg.routines.title'))

@section('current_breadcrumb', __('tfg.routines.list'))

@section('content')
    <routines-component />
    {{-- <div class="d-flex justify-content-between">
        <a href="{{ route('routines.create') }}" class="btn btn-outline-dark"> {{ __('tfg.routines.new') }} </a>
    </div>
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('tfg.tables.id') }}</th>
                                <th>{{ __('tfg.tables.name') }}</th>
                                <th>{{ __('tfg.tables.description') }}</th>
                                <th>{{ __('tfg.tables.created-at') }}</th>
                                <th>{{ __('tfg.tables.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routines as $routine)
                                <tr>
                                    <td>{{ $routine->id }}</td>
                                    <td>{{ $routine->name }}</td>
                                    <td>{{ $routine->description }}</td>
                                    <td>{{ $routine->created_at }}</td>
                                    <td>
                                        <form action="{{ route('routines.destroy', $routine) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('routines.edit', $routine) }} "
                                                class="fas fa-pencil-alt text-inverse m-r-10"></a>
                                            <button type="submit" class="btn btn-danger"><i class="icon-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
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
