@extends('layouts.app')

@section('title', 'Listado Categorias')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ route('categories.create') }}" class="btn btn-outline-dark">Nueva categoria</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Listado categorias') }}</div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Fecha Creacion</th>
                                    <th>Acciones</th>
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
                                                    class="btn btn-outline-secondary btn-sm">Ver</a>
                                                <a href="{{ route('categories.edit', $category) }} "
                                                    class="btn btn-outline-secondary btn-sm">Editar</a>
                                                <button type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $categories->links() }}
                <p>Viendo pagina {{ $categories->currentPage() }} de {{ $categories->lastPage() }} </p>
            </div>
        </div>
    </div>
@endsection
