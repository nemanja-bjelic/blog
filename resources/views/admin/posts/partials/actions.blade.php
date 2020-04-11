<div class="btn-group">
    @if($post->isEnabled())
    <a href="{{ $post->getFrontUrl() }}" class="btn btn-info" target="_blank">
        <i class="fas fa-eye"></i>
    </a>
    @endif
    <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="btn btn-info">
        <i class="fas fa-edit"></i>
    </a>
    <button 
        type="button" 
        class="btn btn-info" 
        data-toggle="modal" 
        data-target="#delete-modal"
        data-action="delete"
        data-id="{{$post->id}}"
        data-name="{{$post->title}}"
    >
        <i class="fas fa-trash"></i>
    </button>
</div>
<div class="btn-group">
@if($post->isEnabled())
<button 
    type="button" 
    class="btn btn-info" 
    data-toggle="modal" 
    data-target="#disable-modal"
    data-action="disable"
    data-id="{{$post->id}}"
    data-name="{{$post->title}}"
>
    <i class="fas fa-minus-circle"></i>
</button>
@endif
@if($post->isDisabled())
<button 
    type="button" 
    class="btn btn-info" 
    data-toggle="modal" 
    data-target="#enable-modal"
    data-action="enable"
    data-id="{{$post->id}}"
    data-name="{{$post->title}}"
>
    <i class="fas fa-check"></i>
</button>
@endif
@if($post->notImportant())
<button 
    type="button" 
    class="btn btn-info" 
    data-toggle="modal" 
    data-target="#important-modal"
    data-action="important"
    data-id="{{$post->id}}"
    data-name="{{$post->title}}"
    >
    <i class="fas fa-bookmark"></i>
</button>
@endif
@if($post->isImportant())
<button 
    type="button" 
    class="btn btn-info" 
    data-toggle="modal" 
    data-target="#unimportant-modal"
    data-action="unimportant"
    data-id="{{$post->id}}"
    data-name="{{$post->title}}"
    >
    <i class="fas fa-times"></i>
</button>
@endif
</div>