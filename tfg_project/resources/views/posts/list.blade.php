@extends('layouts.app')

@section('title', 'Listado Posts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Listado Posts') }}</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Imagen</th>
                                    <th>Body</th>
                                    <th>Commentarios</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            @if($post->image)
                                                Si
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{ $post->body }}</td>
                                        <td>{{ $post->comments->count() }}</td>
                                        <td>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                                <button type="submit">Eliminar</button>
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
