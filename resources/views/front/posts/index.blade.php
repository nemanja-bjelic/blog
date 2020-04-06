@extends('front._layout.layout')

@section('seo_title', 'Blog Posts')

@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                    <!-- post -->
                    <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="blog-post.html"><img src="{{$post->getPhotoUrl()}}" alt="{{$post->title}}" class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last">{{$post->created_at->format('d M | Y')}}</div>
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
                            </div><a href="">
                                <h3 class="h4">{{$post->title}}</h3></a>
                                <p class="text-muted">{{$post->description}}</p>
                            <footer class="post-footer d-flex align-items-center"><a href="blog-author.html" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="{{optional($post->user)->getPhotoUrl()}}" alt="..." class="img-fluid"></div>
                                    <div class="title"><span>{{optional($post->user)->name}}</span></div></a>
                                <div class="date"><i class="icon-clock"></i> {{$post->created_at->diffForHumans()}}</div>
                                <div class="comments meta-last"><i class="icon-comment"></i>{{$post->comments_number}}</div>
                            </footer>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    {{$posts->links()}}
                </nav>
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