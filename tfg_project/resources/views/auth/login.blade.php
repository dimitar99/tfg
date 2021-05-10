@extends('layouts.app-auth')

@section('content')
<section id="wrapper">
    <div class="login-register" style="background-image:url({{ asset('/assets/images/background/gym.jpg') }});">
        <div class="login-box card">
            <div class="card-body">
                <form method="POST" class="form-horizontal form-material" id="loginform" action="{{ route('login') }}">
                    @csrf
                    <h3 class="box-title m-b-20">{{ __('tfg.login.sing_in') }}</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="email" placeholder="{{ __('tfg.login.email') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" placeholder="{{ __('tfg.login.password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex no-block align-items-center">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input class="form-check-input " type="checkbox" name="remember" id="checkbox-signup" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup">{{ __('tfg.login.remember_me') }}</label>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ url('/reset') }}" id="to-recover" class="text-muted"><i class="fa fa-lock m-r-5"></i> {{ __('tfg.login.forgot_pass') }}?</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('tfg.login.login') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection
