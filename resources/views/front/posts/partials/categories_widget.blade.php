<!-- Widget [Categories Widget]-->
<div class="widget categories">
    <header>
        <h3 class="h6">@lang('Categories')</h3>
    </header>
    @foreach(App\Models\PostCategory::query()->orderBy('priority')->withCount(['posts'])->get() as $postCategories)
    <div class="item d-flex justify-content-between">
        <a 
            href="{{route('front.posts.category_posts', ['postCategory' => $postCategories->id])}}"
            >
            {{$postCategories->name}}
        </a><span>{{$postCategories->posts_count}}</span></div>
    @endforeach
</div>