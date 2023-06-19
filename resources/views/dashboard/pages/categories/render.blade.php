@if($create)
    <tr id="row-{{ $category->id }}">
        @endif
        <td></td>
        <td class="name" data-field="name">
            {{$category?->name}}
        </td>
        <td class="status" data-field="status">
            @php $status = \App\Enums\CategoryStatus::getStatus($category->status) @endphp
            <span class="badge badge-{{ $status == "active" ? 'success': 'danger'}}">
                {{ ucfirst($status) }}
            </span>
        </td>
        <td>
            {{$category?->created_at?->diffForHumans()}}
        </td>
        <td class="text-end">
            <button id="edit-button-{{ $category->id }}" class="btn btn-icon edit-record btn-active-light-primary w-30px h-30px me-3"
                    data-route="{{route('admin.categories.edit',$category->id)}}"
                    data-id="{{$category->id}}"
                    title="Edit">
                    <img src="{{asset('icons/write.png')}}" class="action_icon" alt="">
            </button>
            <button class="btn btn-icon  delete-button btn-active-light-primary w-30px h-30px"
                    data-route="{{route('admin.categories.destroy',$category->id)}}"
                    data-id="{{$category->id}}" data-kt-users-table-filter="delete_row"
                    title="Delete">
                    <img src="{{asset('icons/trash.png')}}" class="action_icon" alt="">
            </button>
        </td>
        @if($create)
    </tr>
@endif
