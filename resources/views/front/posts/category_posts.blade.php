@extends('front._layout.layout')

@section('seo_title', $postCategory->name)

@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <h2 class="mb-3">Category "{{$postCategory->name}}"</h2>
                <div class="row">
                   @include('front.posts.partials.posts_list')
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    {{$posts->links()}}
                </nav>
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