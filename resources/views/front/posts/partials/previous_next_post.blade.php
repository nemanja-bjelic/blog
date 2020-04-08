
<div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
    @isset($previousPost)
    <a href="{{ $previousPost->getFrontUrl() }}" class="prev-post text-left d-flex align-items-center">
        <div class="icon prev">
            <i class="fa fa-angle-left"></i>
        </div>
        <div class="text">
            <strong class="text-primary">
                @lang('Previous Post ')
            </strong>
            <h6>{{ $previousPost->title }}</h6>
        </div>
    </a>
    @endisset
    @isset($nextPost)
    <a href="{{ $nextPost->getFrontUrl() }}" class="next-post text-right d-flex align-items-center justify-content-end">
        <div class="text">
            <strong class="text-primary">
                @lang('Next Post')
            </strong>
            <h6>{{ $nextPost->title }}</h6>
        </div>
        <div class="icon next"><i class="fa fa-angle-right">   </i></div>
    </a>
    @endisset
</div>
