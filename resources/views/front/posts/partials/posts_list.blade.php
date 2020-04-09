@foreach($posts as $post)
<!-- post -->
<div class="post col-xl-6">
    <div class="post-thumbnail">
        <a href="{{ $post->getFrontUrl() }}">
            <img src="{{$post->getPhotoUrl()}}" alt="{{$post->title}}" class="img-fluid">
        </a>
    </div>
    <div class="post-details">
        <div class="post-meta d-flex justify-content-between">
            <div class="date meta-last">{{$post->created_at->format('d M | Y')}}</div>
            <div class="category">
                @empty($post->postCategory->id)
                <a>
                    Uncategorized
                </a>
                @endempty
                @isset($post->postCategory->id)
                <a href="{{ $post->postCategory->getFrontUrl() }}">

                    {{optional($post->postCategory)->name}}
                </a>
                @endisset

            </div>
        </div><a href="{{ $post->getFrontUrl() }}">
            <h3 class="h4">{{$post->title}}</h3></a>
        <p class="text-muted">{{$post->description}}</p>
        <footer class="post-footer d-flex align-items-center">
            <a 
                href="{{ optional($post->user)->getFrontUrl() }}" 
                class="author d-flex align-items-center flex-wrap"
            >
                <div class="avatar">
                    <img 
                        src="{{optional($post->user)->getPhotoUrl()}}" 
                        alt="{{optional($post->user)->name}}" 
                        class="img-fluid"
                    >
                </div>
                <div class="title">
                    <span>{{optional($post->user)->name}}</span>
                </div>
            </a>
            <div class="date">
                <i class="icon-clock"></i> 
                {{$post->created_at->diffForHumans()}}
            </div>
            <div class="comments meta-last">
                <i class="icon-comment"></i>
                {{$post->comments_number}}
            </div>
        </footer>
    </div>
</div>
@endforeach