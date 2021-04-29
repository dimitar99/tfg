@extends('layouts.app')

@section('title',  __('tfg.routines-types.list'))

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between">
            <a href="{{ route('routineTypes.create') }}" class="btn btn-outline-dark"> {{ __('tfg.routines-types.new') }} </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('tfg.routines-types.list') }}</div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
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
                                            <form action="{{ route('routineTypes.destroy', $routineType) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('routineTypes.show', $routineType) }}"
                                                    class="btn btn-outline-secondary btn-sm">
                                                    {{ __('tfg.buttons.show') }} </a>
                                                <a href="{{ route('routineTypes.edit', $routineType) }}"
                                                    class="btn btn-outline-secondary btn-sm">
                                                    {{ __('tfg.buttons.edit') }} </a>
                                                <button type="submit"> {{ __('tfg.buttons.delete') }} </button>
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
    </div>
@endsection
