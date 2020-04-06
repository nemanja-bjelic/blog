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