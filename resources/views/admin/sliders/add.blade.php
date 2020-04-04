@extends('admin._layout.layout')
@section('seo_title', __('Add Slider'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Add Slider')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.sliders.index')}}">@lang('Sliders')</a></li>
                        <li class="breadcrumb-item active">@lang('Add Slider')</li>
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
                            <h3 class="card-title">@lang('Add Slider')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="slider-form" action="{{route('admin.sliders.insert')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>@lang('Title')</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control @if($errors->has('title')) is-invalid @endif" 
                                                    placeholder="@lang('Enter title')"
                                                    name="title"
                                                    value="{{old('title')}}"
                                                >
                                                @include('admin._layout.partials.form_errors', ['fieldName' => 'title'])
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Button Title')</label>
                                            <input 
                                                type="text" 
                                                class="form-control @if($errors->has('button_title')) is-invalid @endif" 
                                                placeholder="Enter name"
                                                name="button_title"
                                                value="{{old('button_title')}}"
                                            >
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'button_title'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Button Url')</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control @if($errors->has('button_url')) is-invalid @endif" 
                                                    placeholder="Enter phone"
                                                    name="button_url"
                                                    value="{{old('button_url')}}"
                                                >
                                                @include('admin._layout.partials.form_errors', ['fieldName' => 'button_url'])
                                            
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('Choose Photo')</label>
                                            <input 
                                                type="file" 
                                                class="form-control @if($errors->has('photo')) is-invalid @endif"
                                                name="photo"
                                            >
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                <a href="{{route('admin.sliders.index')}}" class="btn btn-outline-secondary">@lang('Cancel')</a>
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
    
    $('#slider-form').validate({
        "rules": {
            "title": {
                "required": true,
                "maxlength": 255
            },
            "button_title": {
                "required": true,
                "maxlength": 50
            },
            "button_url": {
                "required": true,
                "maxlength": 255
            },
            "photo": {
                "required": true
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