@isset($post->postCategory->name)
<td>
    {{ $post->postCategory->name }}
</td>
@endisset
@empty($post->postCategory->name)
<td>
    UNCATEGORIZED
</td>
@endempty