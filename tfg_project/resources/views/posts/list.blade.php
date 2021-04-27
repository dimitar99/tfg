@extends('layouts.app')

@section('title', 'Listado Posts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('tfg.posts.list') }}</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('tfg.tables.id') }}</th>
                                    <th>{{ __('tfg.tables.image') }}</th>
                                    <th>{{ __('tfg.tables.body') }}</th>
                                    <th>{{ __('tfg.tables.comments') }}</th>
                                    <th>{{ __('tfg.tables.created-at') }}</th>
                                    <th>{{ __('tfg.tables.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            @if ($post->image)
                                                {{ __('tfg.buttons.yes') }}
                                            @else
                                                {{ __('tfg.buttons.no') }}
                                            @endif
                                        </td>
                                        <td>{{ $post->body }}</td>
                                        <td>{{ $post->comments->count() }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('posts.show', $post) }}"
                                                    class="btn btn-outline-secondary btn-sm">
                                                    {{ __('tfg.buttons.show') }} </a>
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
