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
                                    <a href="blog-category.html">
                                        @empty($post->postCategory->name) 
                                        Uncategorized 
                                        @endempty
                                        {{optional($post->postCategory)->name}}
                                    </a>
                                </div>
                            </div><a href="blog-post.html">
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
            <!-- Widget [Latest Posts Widget]        -->
            <div class="widget latest-posts">
                <header>
                    <h3 class="h6">@lang('Latest Posts')</h3>
                </header>
                <div class="blog-posts">
                    @foreach($latestPosts as $latestPost)
                    <a href="blog-post.html">
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="{{$latestPost->getPhotoUrl()}}" alt="{{$latestPost->title}}" class="img-fluid"></div>
                            <div class="title"><strong>{{$latestPost->title}}</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views"><i class="icon-eye"></i> {{$latestPost->visits_number}}</div>
                                    <div class="comments"><i class="icon-comment"></i>{{$latestPost->comments_number}}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            <!-- Widget [Categories Widget]-->
            <div class="widget categories">
                <header>
                    <h3 class="h6">@lang('Categories')</h3>
                </header>
                @foreach($postCategories as $postCategories)
                <div class="item d-flex justify-content-between"><a href="blog-category.html">{{$postCategories->name}}</a><span>{{$postCategories->posts_count}}</span></div>
                @endforeach
            </div>
            <!-- Widget [Tags Cloud Widget]-->
            <div class="widget tags">       
                <header>
                    <h3 class="h6">Tags</h3>
                </header>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="blog-tag.html" class="tag">#Business</a></li>
                    <li class="list-inline-item"><a href="blog-tag.html" class="tag">#Technology</a></li>
                    <li class="list-inline-item"><a href="blog-tag.html" class="tag">#Fashion</a></li>
                    <li class="list-inline-item"><a href="blog-tag.html" class="tag">#Sports</a></li>
                    <li class="list-inline-item"><a href="blog-tag.html" class="tag">#Economy</a></li>
                </ul>
            </div>
        </aside>
    </div>
</div>

@endsection