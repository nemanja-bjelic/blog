@extends('front._layout.layout')
@section('seo_title', $post->title)
@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8"> 
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail"><img src="{{$post->getPhotoUrl()}}" alt="{{$post->title}}" class="img-fluid"></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="category">
                                @empty($post->postCategory->id)
                                <a>
                                    Uncategorized
                                </a>
                                @endempty
                                @isset($post->postCategory->id)
                                <a href="{{route('front.posts.category_posts', ['postCategory' => $post->postCategory->id])}}">

                                    {{optional($post->postCategory)->name}}
                                </a>
                                @endempty
                            </div>
                        </div>
                        <h1>{{$post->title}}
                            <a href="#">
                                <i class="fa fa-bookmark-o"></i>
                            </a>
                        </h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                            <a href="blog-author.html" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar">
                                    <img 
                                        src="{{optional($post->user)->getPhotoUrl()}}" 
                                        alt="{{ optional($post->user)->name }}" 
                                        class="img-fluid"
                                        >
                                </div>
                                <div class="title"><span>{{optional($post->user)->name}}</span></div></a>
                            <div class="d-flex align-items-center flex-wrap">       
                                <div class="date">
                                    <i class="icon-clock"></i> 
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                                <div class="views">
                                    <i class="icon-eye"></i> 
                                    {{ $post->visits_number + 1 }}
                                </div>
                                <div class="comments meta-last">
                                    <a href="#post-comments" id="comments-number-under-image">
                                        <i class="icon-comment"></i>
                                        {{ $post->comments_number }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="post-body">
                            <p class="lead">{{ $post->description }}</p>
                            {{ $post->content }}
                        </div>
                        <div class="post-tags">
                            @foreach($tags as $tag)
                            <a href="{{ $tag->getFrontUrl() }}" class="tag">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        @include('front.posts.partials.previous_next_post')
                        <div class="post-comments" id="post-comments">
                            <header>
                                <h3 class="h6">
                                    @lang('Post Comments')
                                    <span class="no-of-comments" id="comments-number">
                                        ({{ $post->comments_number }})
                                    </span>
                                </h3>
                            </header>
                            <div id="comments">

                            </div>
                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">@lang('Leave a reply')</h3>
                            </header>
                            <form 
                                action="{{route('front.posts.single_post_comment', ['post' => $post])}}" 
                                method="post" 
                                class="commenting-form"
                                id="comment-form"
                                >
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input 
                                            type="text" 
                                            name="user_name"
                                            value="{{ old('user_name') }}"
                                            id="username" 
                                            placeholder="Name" 
                                            class="form-control"
                                            >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input 
                                            type="email" 
                                            name="user_email"
                                            value="{{ old('user_email') }}"
                                            id="useremail" 
                                            placeholder="@lang('Email Address (will not be published)')" 
                                            class="form-control"
                                            >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea 
                                            name="content" 
                                            id="usercomment" 
                                            placeholder="Type your comment" 
                                            class="form-control"
                                            >{{ old('content') }}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button 
                                            type="submit" 
                                            class="btn btn-secondary"
                                            >
                                            @lang('Submit Comment')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <aside class="col-lg-4">
            @include('front.posts.partials.search_widget')
            @include('front.posts.partials.latest_posts_widget')
            @include('front.posts.partials.categories_widget')
            @include('front.posts.partials.tags_widget')
        </aside>
    </div>
</div>
@endsection

@push('footer_javascript')

<!-- jQuery Validation -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>

<script type="text/javascript">
    
    
    function commentsRefresh()
    {
        $.ajax({
            "url": "{{ route('front.posts.show_post_comments', ['post' => $post]) }}",
            "type": "post",
            "data": {
                "_token": "{{ csrf_token() }}"
            }
        }).done(function (response) {
            $('#comments').html(response)
        }).fail(function () {
            console.log('Something went wrong');
        });
        
    }

    $('#comment-form').validate({
        "rules": {
            "user_name": {
                "required": true,
                "minlength": 2,
                "maxlength": 255
            },
            "user_email": {
                "required": true,
                "email": true
            },
            "content": {
                "required": true,
                "minlength": 2,
                "maxlength": 5000
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
    


    $('#comment-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            "url": "{{ route('front.posts.single_post_comment', ['post' => $post]) }}",
            "type": "post",
            "data": $(this).serialize()
        }).done(function (response) {

            toastr.success(response.system_message);
            
            $('[name="user_name"]').val('');
            $('[name="user_email"]').val('');
            $('[name="content"]').val('');
            
            let commentsNumberPlusOne = "{{ $post->comments_number + 1 }}";
            
            $('#comments-number').text(commentsNumberPlusOne);
            $('#comments-number-under-image').text(commentsNumberPlusOne);
            $('#comments-number-latest-posts').text(commentsNumberPlusOne);
            
            commentsRefresh();

        }).fail(function () {
            console.log('something went wrong');
        });
    });



    $.ajax({
        "url": "{{ route('front.posts.increse_views', ['post' => $post->id]) }}",
        "method": "post",
        "data": {
            "_token": "{{ csrf_token() }}"

        }
    });
    
    
    commentsRefresh();
</script>

@endpush