    @if($create)
        <tr id="row-{{ $assessment->id }}">
            @endif
            <td></td>
            <td class="title" data-field="title">
                {{$assessment?->title}}
            </td>
            <td class="type" data-field="type">
                {{$assessment?->type}}
            </td>
            <td class="start_date" data-field="start_date">
                {{ $assessment?->start_date->toDateString()}}
            </td>
            <td class="to_date" data-field="to_date">
                {{$assessment?->to_date->toDateString()}}
            </td>
            <td class="status" data-field="status">
                @isset($assessment)
                    @if ($assessment->status== 'active')
                    <span class="badge badge-success">
                        {{$assessment->status}}
                        </span>
                    @else
                    <span class="badge badge-warning">
                        {{$assessment->status}}
                        </span>
                    @endif
                @endisset
            </td>
            <td class="manager_name" data-field="manager_name">
                {{$assessment?->manager->name}}
            </td>
            <td>
                {{$assessment?->created_at?->diffForHumans()}}
            </td>
            <td class="text-end">
                <a href="{{ url('assessment/show/' . $assessment->id .'/'. $assessment->title) }}" class="btn btn-icon assign-button btn-active-light-primary w-30px h-30px">
                <img src="{{asset('icons/view.png')}}" class="action_icon" style="height:18px" alt="">
                </a>
                @checkAdmin()
                @php
                $rates = App\Models\Rate::where('assessment_id', $assessment->id)
                ->where('status', '!=', App\Enums\RateStatusEnums::PUBLISHED)
                ->get();
                $check_assessment_publish = $assessment->rates->every(function ($rate) {
                return $rate->status != App\Enums\RateStatusEnums::PUBLISHED;
                })
                @endphp
                @if ($check_assessment_publish)
                <button  class="btn btn-icon assign-button btn-active-light-primary assign-question-button w-30px h-30px"
                   data-id="{{$assessment->id}}"
                   title="Assign Question">
                <img src="{{asset('icons/ask.png')}}" class="action_icon" style="height:18px" alt="">
                </button>
                @endif
                <button id="edit-button-{{ $assessment->id }}" class="btn btn-icon edit-record btn-active-light-primary w-30px h-30px  "
                   data-route="{{route('admin.assessment.edit',$assessment->id)}}"
                   data-id="{{$assessment->id}}"
                   title="Edit">
                <img src="{{asset('icons/write.png')}}" class="action_icon"  alt="">
                </button>
                <button class="btn btn-icon  delete-button btn-active-light-primary w-30px h-30px"
                   data-route="{{route('admin.assessments.destroy',$assessment->id)}}"
                   data-id="{{$assessment->id}}" data-kt-assessments-table-filter="delete_row"
                   title="Delete">
                <img src="{{asset('icons/trash.png')}}" class="action_icon" alt=""  >
                </button>
                @endcheckAdmin
             </td>
            @if($create)
        </tr>
@endif

<script>

     $('.assign-question-button').on('click', function() {
        var assessmentId = $(this).data('id');
        var url = "{{ route('admin.assessment.assign', ':id') }}".replace(':id', assessmentId);
        $('#assign-question-form').attr('action', url  );
        $('#assessment_id').attr('value',assessmentId );
      $('#assign-question-modal').modal('show');
    });
</script>

