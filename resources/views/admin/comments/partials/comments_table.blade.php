@foreach($comments as $comment)
<tr>
    <td>#{{ $comment->id }}</td>
    @if($comment->status == 0)
    <td class="text-center">
        <span class="text-danger">disabled</span>
    </td>
    @else
    <td class="text-center">
        <span class="text-success">enabled</span>
    </td>
    @endif
    <td class="text-center">
        <p>{{ $comment->post->title }}</p>
    </td>
    <td>
        <strong>{{ $comment->content }}</strong>
    </td>
    <td>
        <a href="{{ optional($comment->post)->getFrontUrl() }}">
            {{ optional($comment->post)->getFrontUrl() }}
        </a>
    </td>
    <td class="text-center">{{ $comment->created_at }}</td>
    <td class="text-center">
        <div class="btn-group">
            @if($comment->status == 0)
            <button 
                type="button" 
                class="btn btn-info" 
                data-toggle="modal" 
                data-target="#enable-modal"
                data-action="enable"
                data-id="{{$comment->id}}"
                data-name="{{ $comment->content }}"
                >
                <i class="fas fa-check"></i>
            </button>
            @else
            <button 
                type="button" 
                class="btn btn-info" 
                data-toggle="modal" 
                data-target="#disable-modal"
                data-action="disable"
                data-id="{{$comment->id}}"
                data-name="{{ $comment->content }}"
                >
                <i class="fas fa-minus-circle"></i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach