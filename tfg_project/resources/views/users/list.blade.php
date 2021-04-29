@extends('layouts.app')

@section('title', __('tfg.users.list') )

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="{{ route('users.create') }}" class="btn btn-outline-dark"> {{ __('tfg.users.new') }} </a>
        </div>
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">{{ __('tfg.users.list') }}</div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('tfg.tables.id') }}</th>
                                    <th>{{ __('tfg.tables.name') }}</th>
                                    <th>{{ __('tfg.tables.surnames') }}</th>
                                    <th>{{ __('tfg.tables.nick') }}</th>
                                    <th>{{ __('tfg.tables.email') }}</th>
                                    <th>{{ __('tfg.tables.posts') }}</th>
                                    <th>{{ __('tfg.tables.followed') }}</th>
                                    <th>{{ __('tfg.tables.followers') }}</th>
                                    <th>{{ __('tfg.tables.created-at') }}</th>
                                    <th>{{ __('tfg.tables.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surnames }}</td>
                                        <td>{{ $user->nick }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->posts->count() }}</td>
                                        <td>{{ $user->followed->count() }}</td>
                                        <td>{{ $user->followers->count() }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('users.show', $user) }}"
                                                    class="btn btn-outline-secondary btn-sm"> {{ __('tfg.buttons.show') }} </a>
                                                <a href="{{ route('users.edit', $user) }}"
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
