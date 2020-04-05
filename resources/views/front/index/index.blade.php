@extends('front._layout.layout')

@section('seo_title', __('Blog Home Page'))

@section('content')
<!-- Hero Section-->
<div id="index-slider" class="owl-carousel">
    @foreach($sliders as $slider)
    <section style="background: url({{$slider->getPhotoUrl()}}); background-size: cover; background-position: center center" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1>{{$slider->title}}</h1>
                    <a href="{{$slider->getButtonUrl()}}" class="hero-link">{{$slider->button_title}}</a>
                </div>
            </div>
        </div>
    </section>
    @endforeach
</div>

<!-- Intro Section-->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="h3">Some great intro here</h2>
                <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>.</p>
            </div>
        </div>
    </div>
</section>
<section class="featured-posts no-padding-top">
    <div class="container">
        @foreach($posts as $post)
        <!-- Post-->
        <div class="row d-flex align-items-stretch">
            @if($loop->odd)
            <div class="image col-lg-5"><img src="{{$post->getPhotoUrl()}}" alt="{{$post->title}}"></div>
            @endif
            <div class="text col-lg-7">
                <div class="text-inner d-flex align-items-center">
                    <div class="content">
                        <header class="post-header">
                            <div class="category"><a href="blog-category.html">{{optional($post->postCategory)->name}}</a></div><a href="blog-post.html">
                                <h2 class="h4">{{$post->title}}</h2></a>
                        </header>
                        <p>{{$post->description}}</p>
                        <footer class="post-footer d-flex align-items-center"><a href="blog-author.html" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{optional($post->user)->getPhotoUrl()}}" alt="{{optional($post->user)->name}}" class="img-fluid"></div>
                                <div class="title"><span>{{optional($post->user)->name}}</span></div></a>
                            <div class="date"><i class="icon-clock"></i>{{$post->created_at->diffForHumans()}}</div>
                            <div class="comments"><i class="icon-comment"></i>{{$post->comments_number}}</div>
                        </footer>
                    </div>
                </div>
            </div>
            @if($loop->even)
            <div class="image col-lg-5"><img src="{{$post->getPhotoUrl()}}" alt="{{$post->title}}"></div>
            @endif
        </div>
        @endforeach
        
    </div>
</section>
<!-- Divider Section-->
<section style="background: url(/themes/front/img/divider-bg.jpg); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</h2>
                <a href="{{route('front.contact.index')}}" class="hero-link">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- Latest Posts -->
<section class="latest-posts"> 
    <div class="container">
        <header> 
            <h2>Latest from the blog</h2>
            <p class="text-big">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </header>
        <div class="owl-carousel" id="latest-posts-slider">
            @foreach($latestPosts as $latestPost)
            @if(in_array($loop->iteration, [1, 4, 7, 10]))
            <div class="row">
            @endif
                <div class="post col-md-4">
                    <div class="post-thumbnail"><a href="blog-post.html"><img src="{{$latestPost->getPhotoUrl()}}" alt="{{$latestPost->title}}" class="img-fluid"></a></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="date">{{$latestPost->created_at->format('d M | Y')}}</div>
                            <div class="category">
                                <a href="blog-category.html">
                                    @empty($latestPost->postCategory->name) 
                                    Uncategorized 
                                    @endempty
                                    {{optional($latestPost->postCategory)->name}}
                                </a>
                            </div>
                        </div><a href="blog-post.html">
                            <h3 class="h4">{{$latestPost->title}}</h3></a>
                        <p class="text-muted">{{$latestPost->description}}</p>
                    </div>
                </div>
            @if(in_array($loop->iteration, [3, 6, 9, 12]))
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
<!-- Gallery Section-->
<section class="gallery no-padding">    
    <div class="row">
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-1.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-1.jpg')}}" alt="gallery image alt 1" class="img-fluid" title="gallery image title 1">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-2.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-2.jpg')}}" alt="gallery image alt 2" class="img-fluid" title="gallery image title 2">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-3.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-3.jpg')}}" alt="gallery image alt 3" class="img-fluid" title="gallery image title 3">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-4.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-4.jpg')}}" alt="gallery image alt 4" class="img-fluid" title="gallery image title 4">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection