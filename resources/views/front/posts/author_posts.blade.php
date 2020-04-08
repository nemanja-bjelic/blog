@extends('front._layout.layout')
@section('seo_title', $user->name)
@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <h2 class="mb-3 author d-flex align-items-center flex-wrap">
                    <div class="avatar"><img src="{{ $user->getPhotoUrl() }}" alt="{{ $user->name }}" class="img-fluid rounded-circle"></div>
                    <div class="title">
                        <span>@lang('Posts by author')"{{ $user->name }}"</span>
                    </div>
                </h2>
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