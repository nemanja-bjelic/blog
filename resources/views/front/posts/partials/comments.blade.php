@foreach($postComments as $comment)
<div class="comment">
    <div class="comment-header d-flex justify-content-between">
        <div class="user d-flex align-items-center">
            <div class="image"><img src="/themes/front/img/user.svg" alt="{{ $comment->user_name }}" class="img-fluid rounded-circle"></div>
            <div class="title"><strong>{{ $comment->user_name }}</strong><span class="date">{{ $comment->created_at->format('M Y') }}</span></div>
        </div>
    </div>
    <div class="comment-body">
        <p>{{ $comment->content }}</p>
    </div>
</div>
@endforeach