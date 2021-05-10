@extends('layouts.app')

@section('title', __('tfg.categories.list'))

@section('page_title', __('tfg.categories.title'))

@section('current_breadcrumb', __('tfg.categories.list'))

@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{ route('categories.create') }}" class="btn btn-outline-dark"> {{ __('tfg.categories.new') }} </a>
    </div>
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" data-paging="true" data-paging-size="7">
                        <thead>
                            <tr>
                                <th>{{ __('tfg.tables.id') }}</th>
                                <th>{{ __('tfg.tables.name') }}</th>
                                <th>{{ __('tfg.tables.created-at') }}</th>
                                <th>{{ __('tfg.tables.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('categories.edit', $category) }} "
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
