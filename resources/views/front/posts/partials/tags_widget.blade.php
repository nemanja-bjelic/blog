<!-- Widget [Tags Cloud Widget]-->
<div class="widget tags">       
    <header>
        <h3 class="h6">@lang('Tags')</h3>
    </header>
    <ul class="list-inline">
        @foreach($allTags as $tag)
        <li class="list-inline-item"><a href="{{route('front.posts.tag_posts', ['tag' => $tag->id])}}" class="tag">#{{$tag->name}}</a></li>
        @endforeach
    </ul>
</div>