@extends('admin._layout.layout')

@section('seo_title', __('Add User'))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Add new user')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">@lang('Home')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.users.index')}}">@lang('Users')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Add new user')
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Enter data for the user')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        id="entity-form"
                        action="{{route('admin.users.insert')}}"
                        method="post"
                        enctype="multipart/form-data"
                        role="form"
                        >
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Email')</label>

                                        <div class="input-group">
                                            <input 
                                                name="email"
                                                value="{{old('email')}}"
                                                type="email" 
                                                class="form-control @if($errors->has('email')) is-invalid @endif" 
                                                placeholder="@lang('Enter email')"
                                                >
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    @
                                                </span>
                                            </div>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'email'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input 
                                            name="name"
                                            value="{{old('name')}}"
                                            type="text" 
                                            class="form-control @if($errors->has('name')) is-invalid @endif" 
                                            placeholder="@lang('Enter name')"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'name'])
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Phone')</label>
                                        <div class="input-group">
                                            <input 
                                                name="phone"
                                                value="{{old('phone')}}"
                                                type="text" 
                                                class="form-control @if($errors->has('phone')) is-invalid @endif" 
                                                placeholder="@lang('Enter phone')"
                                                >
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                            </div>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'phone'])
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Choose New Photo')</label>
                                        <input 
                                            name="photo" 
                                            type="file" 
                                            class="form-control @if($errors->has('photo')) is-invalid @endif"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-5">

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{route('admin.users.index')}}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('footer_javascript')

<script type="text/javascript">
    
    $('#entity-form').validate({
        "rules": {
            "email": {
                "required": true,
                "maxlength": 255
            },
            "name": {
                "required": true,
                "maxlength": 255
            },
            "phone": {
                "required": true,
                "maxlength": 50
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    
</script>

@endpush