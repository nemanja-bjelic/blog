@extends('auth._layout.layout')
@section('seo_title', __('Blog - Login'))
@section('content')

<!-- NEW HTML -->

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Blog</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">@lang('Sign in to start your session')</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="@lang('Email')"
                        required
                        autocomplete="email" 
                        autofocus
                    >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                
                <div class="input-group mb-3">
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="@lang('Password')"
                        name="password" 
                        required
                        autocomplete="current-password"
                    >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                @lang('Remember Me')
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">@lang('I forgot my password')</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

@endsection
