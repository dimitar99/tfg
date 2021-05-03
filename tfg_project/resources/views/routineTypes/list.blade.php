@extends('layouts.app')

@section('title',  __('tfg.routines-types.list'))

@section('page_title', __('tfg.routines-types.title'))

@section('current_breadcrumb', __('tfg.routines-types.list'))

@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{ route('routineTypes.create') }}" class="btn btn-outline-dark"> {{ __('tfg.routines-types.new') }} </a>
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
                                <th>{{ __('tfg.tables.created-at') }}</th>
                                <th>{{ __('tfg.tables.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routineTypes as $routineType)
                                <tr>
                                    <td>{{ $routineType->id }}</td>
                                    <td>{{ $routineType->name }}</td>
                                    <td>{{ $routineType->created_at }}</td>
                                    <td>
                                        <form action="{{ route('routineTypes.destroy', $routineType) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('routineTypes.edit', $routineType) }} "
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
    </div>
@endsection
