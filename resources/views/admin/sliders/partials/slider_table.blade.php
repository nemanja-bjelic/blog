@foreach($sliders as $slider)
<tr data-id="{{$slider->id}}">
    <td>
        <span style="display: none" class="btn btn-outline-secondary handle">
            <i class="fas fa-sort"></i>
        </span>
        {{$slider->id}}.
    </td>
    <td class="text-center">
        <img src="{{$slider->getPhotoUrl()}}" style="max-width: 80px;">
    </td>
    <td>
        <strong>{{$slider->title}}</strong>
    </td>
    <td>
        {{$slider->button_url}}
    </td>
    @if($slider->status == 0)
    <td class="text-center">
        <span class="text-danger">disabled</span>
    </td>
    @else
    <td class="text-center">
        <span class="text-success">enabled</span>
    </td>
    @endif
    <td class="text-center">{{$slider->updated_at}}</td>
    <td class="text-center">
        <div class="btn-group">
            <a href="{{route('admin.sliders.edit', [$slider->id])}}" class="btn btn-info">
                <i class="fas fa-edit"></i>
            </a>
            @if($slider->status == 0)
            <button 
                type="button" 
                class="btn btn-info" 
                data-toggle="modal" 
                data-target="#enable-modal"
                data-action="enable"
                data-id="{{$slider->id}}"
                data-name="{{$slider->title}}"
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
                data-id="{{$slider->id}}"
                data-name="{{$slider->title}}"
                >
                <i class="fas fa-minus-circle"></i>
            </button>
            @endif
            <button 
                type="button" 
                class="btn btn-info" 
                data-toggle="modal" 
                data-target="#delete-modal"
                data-action="delete"
                data-id="{{$slider->id}}"
                data-name="{{$slider->title}}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
@endforeach