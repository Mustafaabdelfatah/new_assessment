@if($create)
    <tr id="row-{{ $position->id }}">
        @endif
        <td></td>
        <td class="title" data-field="title">
            {{$position?->title}}
        </td>
        <td class="parent" data-field="parent">
            {{ $position->parent_position ? $position->parent_position->title : '-' }}
        </td>
        <td>
            {{$position?->created_at?->diffForHumans()}}
        </td>
        <td class="text-end">
            <button id="edit-button-{{ $position->id }}" class="btn btn-icon edit-record btn-active-light-primary w-30px h-30px me-3"
                    data-route="{{route('admin.positions.edit',$position->id)}}"
                    data-id="{{$position->id}}"
                    title="Edit">
                    <img src="{{asset('icons/write.png')}}" class="action_icon" alt="">
            </button>
            <button class="btn btn-icon  delete-button btn-active-light-primary w-30px h-30px"
                    data-route="{{route('admin.positions.destroy',$position->id)}}"
                    data-id="{{$position->id}}" data-kt-users-table-filter="delete_row"
                    title="Delete">
                    <img src="{{asset('icons/trash.png')}}" class="action_icon" alt="">
            </button>
        </td>

        @if($create)
    </tr>
@endif
