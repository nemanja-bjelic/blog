@extends('admin._layout.layout')

@section('seo_title', 'Edit Post Category')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Edit Post Categories')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index.index') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.post_categories.index') }}">@lang('Post Categories')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Edit Post Categories')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('Edit Post Categories')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" 
                              method="post" 
                              action="{{ route('admin.post_categories.update', ['postCategory' => $postCategory]) }}"
                              id="post-category-form"
                        >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input 
                                        type="text" 
                                        class="form-control @if($errors->has('name')) is-invalid @endif" 
                                        placeholder="@lang('Enter name')"
                                        name="name"
                                        value="{{ old('name', $postCategory->name) }}"
                                    >
                                    @include('admin._layout.partials.form_errors', ['fieldName' => 'name'])
                                </div>
                                <div class="form-group">
                                    <label>@lang('Desription')</label>
                                    <textarea 
                                        class="form-control @if($errors->has('description')) is-invalid @endif" 
                                        placeholder="@lang('Enter description')"
                                        name="description"
                                    >{{old('description', $postCategory->description)}}</textarea>
                                    @include('admin._layout.partials.form_errors', ['fieldName' => 'description'])
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                <a href="{{route('admin.post_categories.index')}}" class="btn btn-outline-secondary">@lang('Cancel')</a>
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
    
    $('#post-category-form').validate({
        "rules": {
            "name": {
                "required": true,
                "maxlength": 255
            },
            "description": {
                "required": true,
                "maxlength": 500
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