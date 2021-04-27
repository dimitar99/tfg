@extends('layouts.app')

@section('title', 'Post')

@section('content')
<div class="container">
    <a href="{{ route('posts.list') }}" class="btn btn-outline-dark btn-sm">{{ __('tfg.buttons.return-to-list') }}</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('tfg.posts.detail') }} {{ $post->id }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        @if($image != "")
                            <img src="{{ $image }}" alt="Foto del post" width="100px" height="100px">
                        @endif
                        <p><strong>{{ __('tfg.forms.fields.id') }}: </strong>{{ $post->id }}</p>
                        <p><strong>{{ __('tfg.forms.fields.user-id') }}: </strong>{{ $post->user_id }}</p>
                        <p><strong>{{ __('tfg.forms.fields.body') }}: </strong>{{ $post->body }}</p>
                        <p><strong>{{ __('tfg.forms.fields.comments') }}: </strong>{{ $post->comments->count() }}</p>
                    </div>
                    @if($post->comments->count() != 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>{{ __('tfg.tables.comment-id') }}</th>
                                        <th>{{ __('tfg.tables.user-id') }}</th>
                                        <th>{{ __('tfg.tables.content') }}</th>
                                        <th>{{ __('tfg.tables.created-at') }}</th>
                                        <th>{{ __('tfg.tables.actions') }}</th>
                                    </tr>
                                </thead>
                                @foreach($post->comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->user_id }}</td>
                                        <td>{{ $comment->body }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">{{ __('tfg.buttons.delete') }}</button>
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
