@if($create)
    <tr id="row-{{ $question->id }}">
        @endif
        <td></td>
        <td class="title" data-field="title">
            {{$question?->title}}
        </td>

        <td class="category" data-field="category">
            {!! $question->categoriesList!!}
         </td>

         <td class="percentage" data-field="percentage">
            {{$question?->percentage}} %
        </td>

        <td>
            {{$question?->created_at?->diffForHumans()}}
        </td>
        <td class="text-end">
            <button id="edit-button-{{ $question->id }}" class="btn btn-icon edit-record btn-active-light-primary w-30px h-30px me-3"
                    data-route="{{route('admin.questions.edit',$question->id)}}"
                    data-id="{{$question->id}}"
                    title="Edit">
                    <img src="{{asset('icons/write.png')}}" class="action_icon" alt="">

            </button>
            <button class="btn btn-icon  delete-button btn-active-light-primary w-30px h-30px"
                    data-route="{{route('admin.questions.destroy',$question->id)}}"
                    data-id="{{$question->id}}" data-kt-users-table-filter="delete_row"
                    title="Delete">
                    <img src="{{asset('icons/trash.png')}}" class="action_icon" alt="">
            </button>
        </td>
  @if($create)
    </tr>
@endif

