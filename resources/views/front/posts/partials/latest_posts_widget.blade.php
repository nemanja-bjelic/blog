<!-- Widget [Latest Posts Widget]        -->
<div class="widget latest-posts">
    <header>
        <h3 class="h6">@lang('Latest Posts')</h3>
    </header>
    <div class="blog-posts">
        @php
        $postIds = implode(',', $latestPostIds);
        @endphp
        @empty($latestPostIds)
        @foreach(App\Models\Post::query()
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get() as $latestPost)
                        
        <a href="{{ $latestPost->getFrontUrl() }}">
            <div class="item d-flex align-items-center">
                <div class="image">
                    <img 
                        src="{{$latestPost->getPhotoThumbUrl()}}" 
                        alt="{{$latestPost->title}}" 
                        class="img-fluid"
                    >
                </div>
                <div class="title">
                    <strong>{{$latestPost->title}}</strong>
                    <div class="d-flex align-items-center">
                        @if((last(\Request::segments()) == Str::slug($latestPost->title)))
                        <div class="views"><i class="icon-eye"></i> {{$latestPost->visits_number + 1}}</div>
                        
                        <div class="comments" id="comments-number-latest-posts">
                            <i class="icon-comment"></i>
                            {{$latestPost->comments_number}}
                        </div>
                        @else
                        <div class="views">
                            <i class="icon-eye"></i> 
                            {{$latestPost->visits_number}}
                        </div>
                        <div class="comments">
                            <i class="icon-comment"></i>
                            {{$latestPost->comments_number}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        @endempty
        @if(!empty($latestPostIds))
        @foreach(App\Models\Post::query()
                        ->where('status', 1)
                        ->whereIn('id', $latestPostIds)
                        ->orderByRaw("FIELD(id, $postIds)")
                        ->get() as $latestPost)
                        
        <a href="{{ $latestPost->getFrontUrl() }}">
            <div class="item d-flex align-items-center">
                <div class="image">
                    <img 
                        src="{{$latestPost->getPhotoThumbUrl()}}" 
                        alt="{{$latestPost->title}}" 
                        class="img-fluid"
                    >
                </div>
                <div class="title">
                    <strong>{{$latestPost->title}}</strong>
                    <div class="d-flex align-items-center">
                        @if((last(\Request::segments()) == Str::slug($latestPost->title)))
                        <div class="views"><i class="icon-eye"></i> {{$latestPost->visits_number + 1}}</div>
                        
                        <div class="comments" id="comments-number-latest-posts">
                            <i class="icon-comment"></i>
                            {{$latestPost->comments_number}}
                        </div>
                        @else
                        <div class="views">
                            <i class="icon-eye"></i> 
                            {{$latestPost->visits_number}}
                        </div>
                        <div class="comments">
                            <i class="icon-comment"></i>
                            {{$latestPost->comments_number}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        @endif
    </div>
</div>