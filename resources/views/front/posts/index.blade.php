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
                                <h3 class="h4">{{Str::limit($post->title, 20)}}</h3></a>
                            <p class="text-muted">{{Str::limit($post->description, 100)}}</p>
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
                    <h3 class="h6">Search the blog</h3>
                </header>
                <form action="blog-search.html" class="search-form">
                    <div class="form-group">
                        <input type="search" placeholder="What are you looking for?">
                        <button type="submit" class="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <!-- Widget [Latest Posts Widget]        -->
            <div class="widget latest-posts">
                <header>
                    <h3 class="h6">Latest Posts</h3>
                </header>
                <div class="blog-posts"><a href="blog-post.html">
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="img/small-thumbnail-1.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>Alberto Savoia Can Teach You About</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views"><i class="icon-eye"></i> 500</div>
                                    <div class="comments"><i class="icon-comment"></i>12</div>
                                </div>
                            </div>
                        </div></a><a href="blog-post.html">
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="img/small-thumbnail-2.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>Alberto Savoia Can Teach You About</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views"><i class="icon-eye"></i> 500</div>
                                    <div class="comments"><i class="icon-comment"></i>12</div>
                                </div>
                            </div>
                        </div></a><a href="blog-post.html">
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="img/small-thumbnail-3.jpg" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>Alberto Savoia Can Teach You About</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views"><i class="icon-eye"></i> 500</div>
                                    <div class="comments"><i class="icon-comment"></i>12</div>
                                </div>
                            </div>
                        </div></a></div>
            </div>
            <!-- Widget [Categories Widget]-->
            <div class="widget categories">
                <header>
                    <h3 class="h6">Categories</h3>
                </header>
                <div class="item d-flex justify-content-between"><a href="blog-category.html">Growth</a><span>12</span></div>
                <div class="item d-flex justify-content-between"><a href="blog-category.html">Local</a><span>25</span></div>
                <div class="item d-flex justify-content-between"><a href="blog-category.html">Sales</a><span>8</span></div>
                <div class="item d-flex justify-content-between"><a href="blog-category.html">Tips</a><span>17</span></div>
                <div class="item d-flex justify-content-between"><a href="blog-category.html">Local</a><span>25</span></div>
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