@extends('auth._layout.layout')
@section('seo_title', __('Blog - Forgot password'))
@section('content')


<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Blog</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
      <p class="login-box-msg">@lang('You forgot your password? Here you can easily retrieve a new password.')</p>

      <form method="POST" action="{{ route('password.email') }}">
          @csrf
        <div class="input-group mb-3">
          <input 
              id="email" 
              type="email" 
              class="form-control @error('email') is-invalid @enderror" 
              name="email" value="{{ old('email') }}" 
              placeholder="@lang('Email')"
              required 
              autocomplete="email" 
              autofocus
            >
          @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">@lang('Request new password')</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{route('login')}}">@lang('Login')</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection
