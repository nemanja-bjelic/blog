@extends('front._layout.layout')

@section('seo_title', 'Search the Blog')
@section('seo_type', 'blog posts')
@section('seo_description', __('Searched our blog by term: ').$searchTerm)

@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <h2 class="mb-3">@lang('Search results for') "{{ $searchTerm }}"</h2>
                <div class="row">
                    @include('front.posts.partials.posts_list')
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    {{ $posts->appends(['search_term' => $searchTerm])->links() }}
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