@extends('app')
@section('title', 'Show Assessment')

@push('css')
     <style>
        .btn-light-primary:hover a {
            color: #f2f2f2 !important
        }
    </style>
@endpush


@section('content')
@php
    use App\Enums\ActionsStatusEnums;
    $rate = App\Models\Rate::where('assessment_id', $assessment->id)
        ->pluck('user_id')
        ->toArray();
    use App\Models\Rate;
@endphp
<div>
<div class="d-flex flex-row">
    <!--begin::Start sidebar-->
    <div class="d-lg-flex flex-column flex-lg-row-auto w-lg-325px" data-kt-drawer="true">
        <!--begin::User menu-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body pt-15 px-0">
                <!--begin::Member-->
                <div class="d-flex flex-column text-center mb-9 px-9">
                    <!--begin::Photo-->
                    <div class="symbol symbol-80px symbol-lg-150px mb-4">
                        <img src="{{ asset('guide.png') }}" class="" alt="">
                    </div>
                    <!--end::Photo-->
                    <!--begin::Info-->
                    <div class="text-center">
                        <!--begin::Name-->
                        <a href="#"
                            class="text-gray-800 fw-bold text-hover-primary fs-4">{{ $assessment->title }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <span class="text-muted d-block fw-semibold">{{ $assessment->type }}</span>
                        <span class="text-muted d-block fw-semibold">{{ $assessment->start_date->format('M d Y') }}</span>
                        <!--end::Position-->
                    </div>
                    <h3 class="text-center my-3 font-weight-bold">
                        Assess Manager
                    </h3>
                    <h3 class="text-center">
                        {{ $assessment?->manager?->name }} - {{ $assessment?->manager?->position?->title }}
                    </h3>

                    <!--end::Info-->
                </div>
                <!--end::Member-->

                <!--begin::Row-->
                <div class="row px-9 mb-4">
                    <!--begin::Col-->
                    <div class="col-md-6 text-center">
                        <div class="text-gray-800 fw-bold fs-3">
                            <span class="m-0 counted" data-kt-countup="true" data-kt-countup-value="642"
                                data-kt-initialized="1">{{ count($assessment->users) }}</span>
                        </div>

                        <span class="text-gray-500 fs-8 d-block fw-bold">Users</span>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-6 text-center">
                        <div class="text-gray-800 fw-bold fs-3">
                            <span class="m-0 counted" data-kt-countup="true" data-kt-countup-value="24"
                                data-kt-initialized="1">{{ count($assessment->questions) }}</span>
                        </div>
                        <span class="text-gray-500 fs-8 d-block fw-bold">Questions</span>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->
        </div>
        <div class="d-lg-flex flex-column flex-lg-row-auto w-lg-325px" style="margin-top:30px;">
            <!--begin::Social widget 1-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Questions
                            <span class="text-muted mt-1 fw-semibold fs-7">({{ count($assessment->questions) }})</span>
                        </span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <!--begin::Item-->
                    @foreach ($assessment->questions as $question)
                        <div class="d-flex flex-stack">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <img src="{{ asset('download (1).png') }}" class="h-50 align-self-center"
                                    alt="">
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <!--begin:Author-->
                                <div class="flex-grow-1 me-2">
                                    <a href="#" onclick="return false"
                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $question->title }}</a>
                                </div>
                                <!--end:Author-->
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Item-->
                        <div class="separator separator-dashed my-4"></div>
                    @endforeach
                </div>
                <!--end::Body-->
            </div>
            <!--end::Social widget 1-->

        </div>

    </div>
    <!--end::Start sidebar-->
    <div class="w-100 flex-lg-row-fluid mx-lg-13">
        <!--begin::Mobile toolbar-->
        <div class="d-flex d-lg-none align-items-center justify-content-end mb-10">
            <div class="d-flex align-items-center gap-2">
                <div class="btn btn-icon btn-active-color-primary w-30px h-30px"
                    id="kt_social_start_sidebar_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                    <span class="svg-icon svg-icon-1"><svg width="18" height="18" viewBox="0 0 18 18"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                                fill="currentColor"></path>
                            <path
                                d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                                fill="currentColor"></path>
                            <rect x="7" y="6" width="4" height="4" rx="2"
                                fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>

                <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_social_end_sidebar_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/coding/cod002.svg-->
                    <span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M18 22C19.7 22 21 20.7 21 19C21 18.5 20.9 18.1 20.7 17.7L15.3 6.30005C15.1 5.90005 15 5.5 15 5C15 3.3 16.3 2 18 2H6C4.3 2 3 3.3 3 5C3 5.5 3.1 5.90005 3.3 6.30005L8.7 17.7C8.9 18.1 9 18.5 9 19C9 20.7 7.7 22 6 22H18Z"
                                fill="currentColor"></path>
                            <path d="M18 2C19.7 2 21 3.3 21 5H9C9 3.3 7.7 2 6 2H18Z" fill="currentColor"></path>
                            <path d="M9 19C9 20.7 7.7 22 6 22C4.3 22 3 20.7 3 19H9Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
        </div>
        <!--end::Mobile toolbar-->
        <!--begin::Followers toolbar-->
        <div class="d-flex flex-wrap flex-stack mb-6">
            <!--begin::Title-->
            <h3 class="text-gray-800 fw-bold my-2">
                Users Assess
                <span class="fs-6 text-gray-400 fw-semibold ms-1">({{ count($assessment->users) }})</span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Followers toolbar-->
        {{-- @dd($assessment->answers) --}}
        <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
            <!--begin::Followers-->
            @foreach ($assessment->users as $key => $user)
                @php
                    $rate = $user
                        ->rates()
                        ->where(['assessment_id' => $assessment->id])
                        ->first();
                    $action = $user
                        ->rates()
                        ->where(['assessment_id' => $assessment->id])
                        ->first()
                        ?->actions()
                        ->where('status', ActionsStatusEnums::RETURNED)
                        ->first();
                @endphp
                <!--begin::Col-->
                <div class="col-md-6">
                    <!--begin::Card-->
                    <div class="card ">
                        @if ($rate)
                            @if ($rate->status == App\Enums\RateStatusEnums::PUBLISHED)
                                <span class="badge bg-success" style="position:absolute;right:11px;top:10px">
                                    {{ 'Published' }}
                                </span>
                            {{-- @elseif($rate->status == App\Enums\RateStatusEnums::PENDING)
                                <span class="badge bg-primary" style="position:absolute;right:11px;top:10px">
                                    {{ 'Pending' }}
                                </span>
                            @else
                                <span class="badge bg-danger" style="position:absolute;right:11px;top:10px">
                                    {{ 'Returned' }}
                                </span> --}}
                            @endif
                        @endif
                        {{-- {{ ($rate->status == App\Enums\RateStatusEnums::PUBLISHED ? 'Accepted' : $rate->status == App\Enums\RateStatusEnums::PENDING) ? 'Pending' : 'Rejected' }} --}}
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center flex-column py-9 px-5">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-65px symbol-circle mb-5">
                                <img src="{{ $user->image_path }}" alt="image">
                                <div
                                    class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                </div>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Name-->
                            <a href="#"
                                class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{ $user->name }}
                                ({{ $user->position->title }})
                            </a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            <div class="fw-semibold text-gray-400 mb-6">{{ $user->email }}</div>
                            {{-- @if ($rate) --}}
                                <div class="fw-bolder  mb-6 new_rate" id="new_rate">
                                    Rate : {{ $rate?->rate   }} %
                                </div>
                            {{-- @endif --}}
                            <div class="">
                                @if (auth()->user()->id == $assessment->manager_id  )
                                    <button type="button" class="btn btn-sm rate_assessment btn-primary d-inline-block mx-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#rateAssessment"
                                        data-route="{{route('admin.assessment.rateAssessment')}}"
                                        data-user="{{$user->id}}"
                                        data-rate="{{$rate?->id}}"
                                        data-assessment_id="{{$assessment?->id}}"
                                        data-user-name="{{$user?->name}}"
                                        >
                                        Rate Assessment
                                    </button>
                                @endif
                                @if ($rate)
                                    <button type="button" class="btn rate_details  btn-sm btn-success d-inline-block mx-1"
                                    data-rate-id="{{$rate->id}}"
                                    data-route="{{route('admin.rate.rate-details')}}"
                                    >
                                        Rate Details
                                    </button>
                                @endif
                                @if ($rate && $action)
                                    <button type="button" class="btn  btn-sm btn-info d-inline-block mx-1"
                                        wire:click.prevent="$emit('action_notes',{{ $action->id }})">
                                        Action Notes
                                    </button>
                                @endif
                            </div>
                            <!--end::Follow-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                    <!--begin::Card-->
                </div>
                <!--end::Col-->
            @endforeach
        </div>
        <!--end::Row-->
        <!--end::Show more-->
    </div>
     {{-- modal for open rate assessment --}}
     <div class="modal fade" id="rateAssessment" tabindex="-1" aria-modal="true" role="dialog">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-900px">
           <!--begin::Modal content-->
           <div class="modal-content">
              <!--begin::Modal header-->
              <div class="modal-header">
                 <!--begin::Modal title-->
                 <h2>Rate Employee <span id="user_name"> </span></h2>
                 {{-- <span id="user_name"></span> --}}
                 <!--end::Modal title-->
                 <!--begin::Close-->
                 <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                 </div>
                 <!--end::Close-->
              </div>
              <!--end::Modal header-->
              <!--begin::Modal body-->
              <div class="modal-body asesss py-lg-10 px-lg-10">
                 <!--begin::Stepper-->

                 <!--end::Stepper-->
              </div>
              <!--end::Modal body-->
           </div>
           <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
     </div>

    {{-- modal for open rate details --}}
    <div class="modal fade"  id="rateDetails" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-positions-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>

                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body  scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_position_form" class="form" method="post"  >
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column detailss scroll-y me-n7 pe-7" id="kt_modal_add_position_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_position_header"
                            data-kt-scroll-wrappers="#kt_modal_add_position_scroll" data-kt-scroll-offset="300px"
                            style="text-align:left;color:#000">
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::End sidebar-->
</div>
</div>
{{-- @include('dashboard.pages.rates.rate_assessment') --}}
@endsection
@push('js')
<script>
 $(document).ready(function() {
          // open modal and assign assessment_id to action

        $('.rate_assessment').on('click', function() {
            var user_id = $(this).data('user');
            var assessment_id = $(this).data('assessment_id');
            $('#user_id').attr('value',user_id );
            var rate_id = $(this).data('rate');
            $('#rate_id').val(rate_id);
            const route = $(this).data('route');
            var user_name = $(this).data('user-name');
            $('#user_name').text('( '+ user_name + ')');
            // $('#rateAssessment').modal('show');
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    rate_id: rate_id,
                    assessment_id: assessment_id,
                },
                success: function (response) {
                    $('.asesss').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
            // Add this code to properly destroy the modal
            $('#rateAssessment').on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
            });
        });



        $(document).on('click', '.rate_details', function () {
            const rate_id = $(this).data('rate-id');
            const route = $(this).data('route');
            $('#rateDetails').modal('show');
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    rate_id: rate_id,
                },
                success: function (response) {
                    $('.detailss').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // $('.rate_details').on('click', function() {

        //     var user_name = $(this).data('user-name');
        //     var question = $(this).data('question');
        //     var rate = $(this).data('rate');
        //     console.log(user_name,answer);
        //     $('#user_name_details').val(user_name);

        //     $('#rateDetails').modal('show');
        // });
    });
</script>
@endpush

