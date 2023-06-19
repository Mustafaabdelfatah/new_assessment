
@if ($rate?->answers)
@foreach ($rate->answers as $key => $answer)
    <!--begin::Input group-->
    <div class="fv-row mb-7">
        <!--begin::Label-->
        <span>  {{$key+1}} : </span><h3 class="fw-bold mb-2" style="display: inline">{{ $answer->question?->title }}?</h3>
        <div class="my-2">
            Question Degree {{ $answer->rate }}
        </div>
        @if ($answer->note)
            <div class="my-2">
                Leader Comment: {{ $answer->note }}
            </div>
        @endif
        <!--end::Input-->
    </div>
    <!--end::Input group-->
@endforeach
@endif

