@extends('layouts.app')

@section('title', 'Listado Categorias')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ route('categories.create') }}" class="btn btn-outline-dark"> {{ __('tfg.categories.new') }} </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('tfg.routines.list') }}</div>

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
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('categories.show', $category) }}"
                                                    class="btn btn-outline-secondary btn-sm"> {{ __('tfg.buttons.show') }} </a>
                                                <a href="{{ route('categories.edit', $category) }} "
                                                    class="btn btn-outline-secondary btn-sm"> {{ __('tfg.buttons.edit') }} </a>
                                                <button type="submit"> {{ __('tfg.buttons.delete') }} </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
