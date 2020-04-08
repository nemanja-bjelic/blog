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
                                    {{ $post->visits_number + 1}}
                                </div>
                                <input type="hidden" value="{{ $post->visits_number }}" name="visits-count">
                                <div class="comments meta-last">
                                    <a href="#post-comments">
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
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                            <a href="#" class="prev-post text-left d-flex align-items-center">
                                <div class="icon prev">
                                    <i class="fa fa-angle-left"></i>
                                </div>
                                <div class="text">
                                    <strong class="text-primary">
                                        @lang('Previous Post ')
                                    </strong>
                                    <h6>I Bought a Wedding Dress.</h6>
                                </div>
                            </a>
                            <a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                                <div class="text">
                                    <strong class="text-primary">
                                        @lag('Next Post')
                                    </strong>
                                    <h6>I Bought a Wedding Dress.</h6>
                                </div>
                                <div class="icon next"><i class="fa fa-angle-right">   </i></div>
                            </a>
                        </div>
                        <div class="post-comments" id="post-comments">
                            <header>
                                <h3 class="h6">
                                    @lang('Post Comments')
                                    <span class="no-of-comments">
                                        ({{ $post->comments_number }})
                                    </span>
                                </h3>
                            </header>
                            <input type="hidden" value="{{ $post->comments_number }}" name="comments_number">
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="title"><strong>Jabi Hernandiz</strong><span class="date">May 2016</span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="title"><strong>Nikolas</strong><span class="date">May 2016</span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="title"><strong>John Doe</strong><span class="date">May 2016</span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">@lang('Leave a reply')</h3>
                            </header>
                            <form action="#" class="commenting-form">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="username" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-secondary">@lang('Submit Comment')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <aside class="col-lg-4">
            <!-- Widget [Search Bar Widget]-->
            <div class="widget search">
                <header>
                    <h3 class="h6">@lang('Search the blog')</h3>
                </header>
                <form action="blog-search.html" class="search-form">
                    <div class="form-group">
                        <input type="search" placeholder="@lang('What are you looking for')?">
                        <button type="submit" class="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            @include('front.posts.partials.latest_posts_widget')
            @include('front.posts.partials.categories_widget')
            @include('front.posts.partials.tags_widget')
        </aside>
    </div>
</div>
@endsection

@push('footer_javascript')

<script type="text/javascript">
    
  
    $.ajax({
        "url": "{{ route('front.posts.increse_views', ['post' => $post->id]) }}",
        "method": "post",
        "data": {
            "_token": "{{ csrf_token() }}"
            
        }
    });
</script>

@endpush