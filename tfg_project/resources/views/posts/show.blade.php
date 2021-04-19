@extends('layouts.app')

@section('title', 'Post')

@section('content')
<div class="container">
    <a href="{{ route('posts.list') }}" class="btn btn-outline-dark btn-sm">Regresar al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detalle de Post
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>USER ID: </strong>{{ $post->user_id }}</p>
                        <p><strong>POST ID: </strong>{{ $post->id }}</p>
                        <p><strong>IMAGE: </strong>{{ $post->image }}</p>
                        <p><strong>BODY: </strong>{{ $post->body }}</p>
                        <p><strong>COMMENTS: </strong>{{ $post->comments->count() }}</p>
                    </div>
                    @if($post->comments->count() != 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>COMMENT ID</th>
                                        <th>USER ID</th>
                                        <th>CONTENT</th>
                                        <th>CREATED_AT</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach($post->comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->user_id }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
