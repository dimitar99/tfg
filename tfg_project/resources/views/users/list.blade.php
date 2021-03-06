@extends('layouts.app')

@section('title', __('tfg.users.list'))

@section('page_title', __('tfg.users.title'))

@section('current_breadcrumb', __('tfg.users.list'))

@section('content')
    <div class="row el-element-overlay" data-paging="true" data-paging-size="7">
        @foreach ($users as $user)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <img src="{{ $user->avatar }}" alt="avatar" class="rounded mx-auto d-block"
                                style="height: 250px; width: auto" />
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li>
                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                            href="{{ route('users.show', $user) }}"><i class="icon-magnifier"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a type="button" class="btn btn-info" href="{{ route('users.edit', $user) }}">
                                            <i class="icon-pencil"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="icon-trash"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <p><strong>{{ '@' . $user->nick }}</strong></p>
                            <small>{{ $user->name . ' ' . $user->surnames }}</small>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="float-right">
        {{ $users->links() }}
    </div>
@endsection
