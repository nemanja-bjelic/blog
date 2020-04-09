<!-- Widget [Categories Widget]-->
<div class="widget categories">
    <header>
        <h3 class="h6">@lang('Categories')</h3>
    </header>
    @foreach(App\Models\PostCategory::query()->orderBy('priority')->withCount(['posts'])->get() as $postCategory)
    <div class="item d-flex justify-content-between">
        <a 
            href="{{ $postCategory->getFrontUrl() }}"
            >
            {{$postCategory->name}}
        </a><span>{{$postCategory->posts_count}}</span></div>
    @endforeach
</div>