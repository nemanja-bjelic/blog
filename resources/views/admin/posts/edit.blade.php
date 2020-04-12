@extends('admin._layout.layout')

@section('seo_title', 'Edit Post')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Edit Post')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">@lang('Post')</a></li>
                        <li class="breadcrumb-item active">@lang('Edit Post')</li>
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
                            <h3 class="card-title">@lang('Edit Post')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="entity-form" action="{{ route('admin.posts.update', ['post' => $post]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label>@lang('Category')</label>
                                            <select 
                                                name="post_category_id"
                                                class="form-control @if($errors->has('post_category_id')) is-invalid @endif"
                                            >
                                                <option value="">-- @lang('Choose Category') --</option>
                                                @foreach(App\Models\PostCategory::all() as $postCategory)
                                                <option 
                                                    value="{{ $postCategory->id }}"
                                                    @if($postCategory->id == old('post_category_id', $post->post_category_id))
                                                    selected
                                                    @endif
                                                >
                                                    {{ $postCategory->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'post_category_id'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Title')</label>
                                            <input 
                                                type="text" 
                                                name="title"
                                                value="{{ old('title', $post->title) }}"
                                                class="form-control @if($errors->has('title')) is-invalid @endif" 
                                                placeholder="@lang('Enter title')"
                                            >
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'title'])
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('Description')</label>
                                            <textarea 
                                                class="form-control @if($errors->has('description')) is-invalid @endif"
                                                name="description"
                                                placeholder="@lang('Enter Description')"
                                            >{{ old('description', $post->description) }}</textarea>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'description'])
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>@lang('Important')</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input 
                                                    type="radio" 
                                                    id="set-as-unimportant" 
                                                    name="important"
                                                    value="0"
                                                    @if(0 == old('important', $post->important))
                                                    checked
                                                    @endif
                                                    class="custom-control-input"
                                                    >
                                                    <label class="custom-control-label" for="set-as-unimportant">@lang('No')</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input 
                                                    type="radio" 
                                                    id="set-as-important" 
                                                    name="important"
                                                    value="1"
                                                    @if(1 == old('important', $post->important))
                                                    checked
                                                    @endif
                                                    class="custom-control-input"
                                                    >
                                                    <label class="custom-control-label" for="set-as-important">@lang('Yes')</label>
                                            </div>
                                            <div style="display:none;" class="form-control @if($errors->has('important')) is-invalid @endif"></div>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'important'])
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('Tags')</label>
                                            <div>
                                                @foreach(App\Models\Tag::all() as $tag)
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        name="tag_id[]"
                                                        value="{{ $tag->id }}"
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        id="tag-checkbox-{{ $tag->id }}"
                                                        @if(is_array(old('tag_id', $post->tags->pluck('id')->toArray())) 
                                                        && in_array($tag->id, old('tag_id', $post->tags->pluck('id')->toArray())))
                                                        checked
                                                        @endif
                                                    >
                                                    <label class="form-check-label" for="tag-checkbox-{{ $tag->id }}">{{ $tag->name }}</label>
                                                </div>
                                                @endforeach
                                                <div style="display:none;" class="form-control @if($errors->has('tag_id')) is-invalid @endif"></div>
                                                @include('admin._layout.partials.form_errors', ['fieldName' => 'tag_id'])
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
                                        <div class="form-group">
                                            <label>@lang('Content')</label>
                                            <textarea 
                                                name="content"
                                                class="form-control @if($errors->has('content')) is-invalid @endif" 
                                                placeholder="@lang('Enter Content')"
                                                >{{old('content', $post->content)}}</textarea>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'content'])
                                        </div>
                                    </div>
                                    <div class="offset-md-1 col-md-5">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>@lang('Photo')</label>

                                                    <div class="text-right">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            data-action="delete-photo"
                                                        >
                                                            <i class="fas fa-remove"></i>
                                                            @lang('Delete Photo')
                                                        </button>
                                                    </div>
                                                    <div class="text-center">
                                                        <img 
                                                            src="{{ $post->getPhotoUrl() }}" 
                                                            alt="{{ $post->title }}" 
                                                            class="img-fluid"
                                                            data-container="photo"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">@lang('Cancel')</a>
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

<script src="{{ url('/themes/admin/plugins/ckeditor_4.14.0_64e38103ede3/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ url('/themes/admin/plugins/ckeditor_4.14.0_64e38103ede3/ckeditor/adapters/jquery.js') }}" type="text/javascript"></script>

<script>

    $('#entity-form [name="content"]').ckeditor({
        "height": "600px",
        "width": "600px",
        "filebrowserBrowseUrl": "{{route('elfinder.ckeditor')}}"
    });
    
    // delete photo
    $('#entity-form').on('click', '[data-action="delete-photo"]', function (e) {
    e.preventDefault();


    $.ajax({
        "url": "{{route('admin.posts.delete_photo', ['post' => $post->id])}}",
        "type": "post",
        "data": {
            "_token": "{{csrf_token()}}"
        }
    }).done(function (response) {

        toastr.success(response.system_message);

        $('img[data-container="photo"]').attr('src', response.photo_url);

    }).fail(function () {
        toastr.error('Error while deleteing photo');
    });
    });
    
    
    
    $('#entity-form').validate({
    rules: {
        "title": {
            "required": true,
            "minlength": 20,
            "maxlength": 255
        },
        "description": {
            "required": true,
            "minlength": 50,
            "maxlength": 500
        },
        "important": {
            "required": true
        },
        "tag_id[]": {
            "required": true,
        }

    },
    errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
                
                $(element).addClass('is-invalid');
                $('[name="tag_id[]"]').removeClass('is-invalid');
            
            
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
});

</script>

@endpush

