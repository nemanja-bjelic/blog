@if($post->isImportant())
<span class="text-success">@lang('Yes')</span>
@endif
@if($post->notImportant())
<span class="text-danger">@lang('No')</span>
@endif