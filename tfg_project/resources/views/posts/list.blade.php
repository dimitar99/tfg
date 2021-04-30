@extends('layouts.app')

@section('title', __('tfg.posts.list'))

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row el-element-overlay">
        @foreach ($posts as $post)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <img src="{{ $post->image }}" alt="user" />
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li><a class="btn default btn-outline image-popup-vertical-fit"
                                            href="{{ $post->image }}"><i class="icon-magnifier"></i></a></li>
                                    <li>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="icon-trash"></i></button>
                                        </form>
                                    <li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <p><strong>{{ '@' }}{{ $post->user->nick }}</strong></p>
                            <small>{{ $post->body }}</small>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
@endsection
