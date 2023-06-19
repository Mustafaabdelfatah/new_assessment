@if(!$isAdmin)
    @if($create)
        <tr id="row-{{ $user->id }}">
            @endif
            <td></td>
            <td class="name" data-field="name">
                {{$user?->name}}
            </td>
            <td class="email" data-field="email">
                {{$user?->email}}
            </td>
            <td class="image" data-field="image">
                <img src="{{$user?->image_path}}" style="width: 50px;height:50px" class="img-thumbnail rounded d-block" alt="" >
            </td>
            <td class="position" data-field="position">
                {{$user?->position?->title ?? 'No position assigned'}}
            </td>
            <td>
                {{$user?->created_at?->diffForHumans()}}
            </td>
            <td class="text-end">
                <button id="edit-button-{{ $user->id }}" class="btn btn-icon edit-record btn-active-light-primary w-30px h-30px me-3"
                    data-route="{{route('admin.users.edit',$user->id)}}"
                    data-id="{{$user->id}}"
                    title="Edit">
                    <img src="{{asset('icons/write.png')}}" class="action_icon" alt="">
                </button>
                <button class="btn btn-icon  delete-button btn-active-light-primary w-30px h-30px"
                        data-route="{{route('admin.users.destroy',$user->id)}}"
                        data-id="{{$user->id}}" data-kt-users-table-filter="delete_row"
                        title="Delete">
                        <img src="{{asset('icons/trash.png')}}" class="action_icon" alt="">
                </button>
            </td>
            @if($create)
        </tr>
    @endif
@endif
