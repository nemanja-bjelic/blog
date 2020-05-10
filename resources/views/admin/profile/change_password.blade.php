@extends('auth._layout.layout')
@section('seo_title', __('Blog - Change Password'))
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Blog</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

<p class="login-box-msg">@lang('Change your password').</p>

<form action="{{route('admin.profile.change_password_confirm')}}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input 
            name="old_password"
            type="password" 
            class="form-control @if($errors->has('old_password')) is-invalid @endif" 
            placeholder="@lang('Old Password')"
            >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock-open"></span>
            </div>
        </div>
        @include('admin._layout.partials.form_errors', ['fieldName' => 'old_password'])

    </div>
    <div class="input-group mb-3">
        <input 
            name="new_password"
            type="password" 
            class="form-control @if($errors->has('new_password')) is-invalid @endif " 
            placeholder="@lang('New Password')"
            >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @include('admin._layout.partials.form_errors', ['fieldName' => 'new_password'])
    </div>
    <div class="input-group mb-3">
        <input 
            name="new_password_confirm"
            type="password" 
            class="form-control @if($errors->has('new_password_confirm')) is-invalid @endif" 
            placeholder="@lang('Confirm New Password')"
            >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @include('admin._layout.partials.form_errors', ['fieldName' => 'new_password_confirm'])
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">@lang('Confirm Password Change')</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="{{ route('password.request') }}">@lang('I forgot my password')</a>
</p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection