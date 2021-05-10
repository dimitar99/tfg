@extends('layouts.app-auth')

@section('content')
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{ asset('/assets/images/background/gym.jpg') }});">
            <div class="login-box card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" class="form-horizontal form-material" id="loginform" action="{{ route('password.email') }}">
                        @csrf
                        @method("POST")
                        <div class="form-group">
                            <div class="col-xs-12">
                                <h3>{{ __('tfg.restore_pass') }}</h3>
                                <p class="text-muted">{{ __('tfg.restore_info') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
