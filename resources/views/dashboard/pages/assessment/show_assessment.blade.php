@extends('app')
@section('title', 'Show Assessment')
@push('css')
    <style>
        .collect p {
            padding: 1px 0;
            cursor: pointer;
        }

        .collect p img {
            width: 22px;
        }

        .btn-light-primary:hover a {
            color: #f2f2f2 !important
        }

        .card:hover .Rate-icons-container {
            opacity: 1;
            transform: translateY(0);
        }

        .Rate-icons-container {
            position: absolute;
            right: -26px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .Rate-icons {
            display: inline-grid;
        }

        .Rate-icons span img {
            width: 20px;
            padding: 5px 0
        }

        .rate_assessment {}
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

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar text-center pt-7 pt-lg-10 ">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex align-items-stretch ">
                    <!--begin::Toolbar container-->
                    <div class="d-flex ">
                        @foreach ($dateByMonth as $date)
                            <div class="date" style="padding:10px">
                                <a data-route="{{ route('admin.renderAssessmentByDate', $date->id) }}"
                                    data-id="{{ $date->id }}" data-title="{{ $date->title }}"
                                    class="btn btn-sm btn-primary renderAssessment">
                                    {{ $date->start_date->format('Y-m-d') }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content ">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-fluid render_assessment">
                    <!--begin::Navbar-->
                    <div class="card mb-8">
                        <div class="card-body pt-9 pb-0">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                <!--begin::Image-->
                                <div
                                    class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                    <img class="mw-50px mw-lg-75px" src="{{ asset('icons/assessment.webp') }}"
                                        alt="image">
                                </div>
                                <!--end::Image-->
                                <!--begin::Wrapper-->
                                <div class="flex-grow-1">
                                    <!--begin::Head-->
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <!--begin::Details-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Status-->
                                            <div class="d-flex align-items-center mb-1">
                                                <a href="#"
                                                    class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $assessment->title }}</a>
                                                <span
                                                    class="badge badge-light-success me-auto">{{ $assessment->status }}</span>
                                            </div>
                                            <!--end::Status-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Actions-->
                                        <div class="d-flex mb-4">
                                            <a href="#"
                                                data-route="{{ route('admin.renderAssessmentByQuestion', $assessment->id) }}"
                                                data-assessment_id="{{ $assessment->id }}"
                                                class=" btn btn-sm btn-primary assessment_question ">Assessment
                                                Questions</a>
                                            <!--begin::Menu-->
                                            <div class="me-0">
                                                <!--begin::Menu 3-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                    data-kt-menu="true">
                                                </div>
                                                <!--end::Menu 3-->
                                            </div>
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-4 fw-bold">{{ $assessment->start_date->format('d-m-y') }}
                                                    </div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400">Date Of Assessment</div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    {{-- <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i> --}}
                                                    <div class="fs-4 fw-bold counted" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $assessment->users_count }}"
                                                        data-kt-initialized="1">{{ $assessment->users_count }}</div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400">Num Of Employee</div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    {{-- <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i> --}}
                                                    <div class="fs-4 fw-bold counted" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $assessment->questions_count }}"
                                                        data-kt-initialized="1">{{ $assessment->questions_count }}</div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400">Num Of Questions</div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                        <div class="symbol-group symbol-hover">
                                            @foreach ($assessment->users->take(6) as $user)
                                                <!--begin::User-->
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                    aria-label="{{ $user->name }}"
                                                    data-bs-original-title="{{ $user->name }}" data-kt-initialized="1">
                                                    <img alt="{{ $user->name }}" src="{{ $user->image_path }}">
                                                </div>
                                                <!--end::User-->
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Details-->
                            <div class="separator"></div>
                        </div>
                    </div>
                    <!--end::Navbar-->
                    <!--begin::Toolbar-->
                    <div class="d-flex flex-wrap flex-stack pb-7">
                        <!--begin::Title-->
                        <div class="d-flex flex-wrap align-items-center my-1">
                            <h3 class="fw-bold me-5 my-1">Employee ({{ $assessment->users_count }})</h3>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel">
                            <!--begin::Row-->
                            <div class="row g-6 g-xl-9">

                                <!--begin::Col-->
                                @foreach ($users as $key => $user)
                                    @php
                                        $rate = $user
                                            ->rates()
                                            ->where(['assessment_id' => $assessment->id])
                                            ->first();
                                        // dump($user->rates)
                                    @endphp
                                    <div class="col-md-6 col-xxl-4">
                                        <!--begin::Card-->
                                        <div class="card" id="show-buttons-{{ $user->id }}">

                                            <div class="card-header border-0 pt-9">
                                                {{-- <div class="Rate-icons-container">
                                                    <div class="Rate-icons">
                                                        <span>
                                                            <img src="{{asset('icons/file.png')}}" alt="">
                                                        </span>
                                                        <span>
                                                            <img src="{{asset('icons/send.png')}}" alt="">
                                                        </span>
                                                        <span>
                                                            <img src="{{asset('icons/check-list.png')}}" alt="">
                                                        </span>
                                                    </div>
                                                </div> --}}
                                                <!-------------- calcutate the  percentage of answers------------>
                                                @php
                                                    $questions = $assessment->questions()->count();
                                                    $count_answers = $user
                                                        ->answers()
                                                        ->where('rate', '!=', null)
                                                        ->where('assessment_id', $assessment->id)
                                                        ->count();
                                                    if ($count_answers) {
                                                        $percentage_of_answer = ($count_answers / $questions) * 100;
                                                    } else {
                                                        $percentage_of_answer = 0;
                                                    }
                                                @endphp

                                                <!-------show input range when assessment have questions----->
                                                @if ($questions > 0)
                                                    <label for="customRange1" class="form-label" style="color:#6eaf26">Total
                                                        rating : {{ number_format($percentage_of_answer, 0) }} %</label>
                                                    <input type="range" class="form-range" min="0" max="100"
                                                        value="{{ $percentage_of_answer }}"id="customRange1"><br><br>
                                                @endif

                                                <!-------------------show buttons  on card------------->
                                                <div class="collect" style="position: absolute; display:grid; right:-26px"
                                                    id="collection-{{ $user->id }}">
                                                    @if (auth()->user()->id == $assessment->manager_id && (!$rate || $rate->status->value == 'pending'))
                                                        <p class="rate_assessment
                                                    @if ($rate?->status?->value == 'published') d-none @endif"
                                                            title="Rate"
                                                            data-route="{{ route('admin.assessment.rate-assessment') }}"
                                                            data-user="{{ $user?->id }}"
                                                            data-rate="{{ $rate?->id }}"
                                                            data-assessment_id="{{ $assessment?->id }}"
                                                            data-user-name="{{ $user?->name }}"
                                                            data-user-position="{{ $user?->position?->title }}"
                                                            data-user-rate="{{ $rate?->rate }}">
                                                            <img src="{{ asset('icons/check-list.png') }}"
                                                                alt="">
                                                        </p>
                                                    @endif

                                                    @if ($rate)
                                                        @if ($rate->status->value == 'pending')
                                                            <p class="publishModal" data-rate-id="{{ $rate->id }}"
                                                                title="Punlish">
                                                                <img src="{{ asset('icons/send.png') }}" alt="">
                                                            </p>
                                                        @endif

                                                        <p class="rate_details" data-rate-id="{{ $rate->id }}"
                                                            title="Details"
                                                            data-route="{{ route('admin.rate.rate-details') }}">
                                                            <img src="{{ asset('icons/file.png') }}" alt="">
                                                        </p>
                                                    @endif
                                                    <!--begin::Card Title-->
                                                    {{-- <div class="card-title m-0">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-50px w-50px bg-light"
                                                            id="show-{{ $user->id }}">
                                                            @if (auth()->user()->id == $assessment->manager_id && (!$rate || $rate->status->value == 'pending'))
                                                                <button type="button"
                                                                    class="rate_assessment badge badge-primary fw-bold me-auto px-4 py-3
                                                            @if ($rate?->status?->value == 'published') d-none @endif"
                                                                    data-route="{{ route('admin.assessment.rate-assessment') }}"
                                                                    data-user="{{ $user?->id }}"
                                                                    data-rate="{{ $rate?->id }}"
                                                                    data-assessment_id="{{ $assessment?->id }}"
                                                                    data-user-name="{{ $user?->name }}"
                                                                    data-user-position="{{ $user?->position?->title }}"
                                                                    data-user-rate="{{ $rate?->rate }}"
                                                                    style="border:none">
                                                                    Rate Assessment
                                                                </button>
                                                            @endif
                                                            <!--begin::Card Title-->
                                                            <!--end::Car Title-->
                                                            <!--begin::Card toolbar-->
                                                            <div class="card-toolbar">
                                                                @if ($rate)
                                                                    @if ($rate->status->value == 'pending')
                                                                        <button type="button"
                                                                            class="btn publishModal  btn-sm btn-success d-inline-block mx-1"
                                                                            data-rate-id="{{ $rate->id }}">
                                                                            publish
                                                                        </button>
                                                                    @endif
                                                                    <button type="button"
                                                                        class="btn rate_details  btn-sm btn-success d-inline-block mx-1"
                                                                        data-rate-id="{{ $rate->id }}"
                                                                        data-route="{{ route('admin.rate.rate-details') }}">
                                                                        Rate Details
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <!--end::Card toolbar-->
                                                        </div>
                                                        <!--end::Avatar-->
                                                    </div>
                                                    <!--end::Car Title-->
                                                    <!--begin::Card toolbar-->
                                                    <div class="card-toolbar" id="show-{{ $user->id }}">
                                                        @if ($rate)
                                                            @if ($rate->status->value == 'pending')
                                                                <button type="button"
                                                                    class="btn publishModal  btn-sm btn-success d-inline-block mx-1"
                                                                    data-rate-id="{{ $rate->id }}">
                                                                    publish
                                                                </button>
                                                            @endif
                                                            <button type="button"
                                                                class="btn rate_details  btn-sm btn-success d-inline-block mx-1"
                                                                data-rate-id="{{ $rate->id }}"
                                                                data-route="{{ route('admin.rate.rate-details') }}">
                                                                Rate Details
                                                            </button>
                                                        @endif
                                                    </div> --}}
                                                    <!--end::Card toolbar-->
                                                </div>
                                            </div>
                                            <!--begin::Card body-->
                                            <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-65px symbol-circle mb-5">
                                                    <img src="{{ $user->image_path }}" alt="image">
                                                    <div
                                                        class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
                                                    </div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Name-->
                                                <a href="#"
                                                    class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{ $user->name }}</a>
                                                <!--end::Name-->
                                                <!--begin::Position-->
                                                <div class="fw-semibold text-gray-400 mb-6">{{ $user->position->title }}
                                                </div>
                                                <!--end::Position-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-center flex-wrap">
                                                    <!--begin::Stats-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                        <div class="fw-semibold text-gray-400">
                                                            {{ $rate?->rate ? 'Rate ' : 'Not Rated' }}</div>

                                                        <div class="fs-6 fw-bold text-gray-700">
                                                            {{ $rate?->rate ? $rate?->rate . '%' : '' }}
                                                        </div>
                                                    </div>
                                                    <!--end::Stats-->
                                                    <!--begin::Stats-->
                                                    {{-- <div
                                                        class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                        <div class="fs-6 fw-bold text-gray-700">
                                                            {{ $assessment->start_date->format('y-m-d') }}</div>
                                                        <div class="fw-semibold text-gray-400">Date</div>
                                                    </div> --}}
                                                    <!--end::Stats-->
                                                    <!--begin::Stats-->
                                                    {{-- <div
                                                        class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                        <div class="fs-6 fw-bold text-gray-700">
                                                            {{ $assessment?->manager?->name }}</div>
                                                        <div class="fw-semibold text-gray-400">Manager Name</div>
                                                    </div> --}}
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                @endforeach
                                {{ $users->links('pagination::simple-bootstrap-5') }}
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
            <div class="modal fade" id="rateAssessment" tabindex="-1" aria-modal="true" role="dialog">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-900px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <div>
                                <h4 style="color:#718093">Rate Employee: <span style="color:#38ada9"
                                        id="user_name"></span></h4>
                            </div>
                            <div>
                                <h4 style="color:#718093">Postion: <span style="color:#38ada9" id="user_position"></span>
                                </h4>
                            </div>
                            <div>
                                <h4 style="color:#718093">Rate: <span style="color:#38ada9" id="user_rate"></span></h4>
                            </div>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                {{-- <i class="ki-outline ki-cross fs-1"></i> --}}
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body  py-lg-10 px-lg-10">


                            <form class="form" id="myForm" method="POST">
                                @csrf
                                <div class="rate_asesssment"></div>

                                {{-- <button type="submit" class="btn btn-sm btn-primary" id="submitButton"
                                        data-kt-stepper-action="submit">
                                    <span class="indicator-label">
                                        Save And Close
                                        <i class="ki-outline ki-arrow-right fs-3 ms-2 me-0"></i>
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button> --}}
                            </form>

                        </div>

                        <!--end::Modal body-->
                    </div>

                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->

            </div>

            <div class="modal fade" id="rateDetails" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" id="closeDetailsModal"
                                data-kt-positions-modal-action="close">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                            height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                            fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2"
                                            rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                            <form id="kt_modal_add_position_form" class="form" method="post">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column detailss scroll-y me-n7 pe-7"
                                    id="kt_modal_add_position_scroll" data-kt-scroll="true"
                                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_add_position_header"
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
            <div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-labelledby="meetingCancel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-l " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-primary">Alert</h3>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-danger">Are You sure that you want to Publish this Attachment </h5>
                            <div class="row flex justify-content-end col-12">
                                <button class="btn btn-light-primary col-4 submitPublishModal">yes</button>
                                <button class="btn btn-light-danger col-4 closePublishModal">cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="assessmentQuestion" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_user_header">
                            <!--begin::Close-->
                            <h5 class="modal-title" id="questionModalLabel">Questions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="background: none;border:none">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body questions">
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
            </div>
            <!--end::Content wrapper-->
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/crud/table.js') }}"></script>



    <!----------------------show button on card------------------------->
    @foreach ($users as $user)
        <script>
            $(document).ready(function() {
                $("#collection-{{ $user->id }}").hide();

                $("#show-buttons-{{ $user->id }}").hover(function() {
                    $("#collection-{{ $user->id }}").fadeIn(500);
                }, function() {
                    $("#collection-{{ $user->id }}").fadeOut(500);
                });
            });
        </script>
    @endforeach

    <script></script>
    <script>
        $(document).ready(function() {

            let id;
            let clickedButton;
            let rateAssessment;
            $('.publishModal').on('click', function() {
                $("#publishModal").modal('show');
                id = $(this).attr('data-rate-id');
                clickedButton = $(this);
                rateAssessment = $(this).closest('.card').find('.rate_assessment');
            });
            $('.submitPublishModal').on('click', function() {
                $.ajax({
                    url: `/assessment/rate/update-status/${id}`,
                    type: 'POST',
                    success: function(data) {
                        $("#publishModal").modal('hide');
                        if (data['success'] == true) {
                            rateAssessment.hide();
                            clickedButton.addClass('d-none');
                            toastr.success(data['message']);
                        } else {
                            toastr.error(data['message']);
                        }
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        toastr.error(errorMessage);
                    },
                })
            });
            $('.closePublishModal').on('click', function() {
                $("#publishModal").modal('hide');
            });

            // open modal and assign assessment_id to action
            $('.rate_assessment').on('click', function() {
                const user_id = $(this).data('user');
                const assessment_id = $(this).data('assessment_id');
                const rate_id = $(this).data('rate');
                const user_name = $(this).data('user-name');
                const user_position = $(this).data('user-position');
                const user_rate = $(this).data('user-rate');

                const route = $(this).data('route');

                $('#user_id').attr('value', user_id);
                $('#rate_id').val(rate_id);
                $('#user_name').text('' + user_name + '');
                $('#user_position').text(' ' + user_position + '');
                $('#user_rate').text(' ' + user_rate + '');

                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        rate_id: rate_id,
                        user_id: user_id,
                        assessment_id: assessment_id,
                    },
                    success: function(response) {
                        $('.rate_asesssment').html(response);
                        $('.form-select').select2({});
                        $('li.nav-item').each(function() {
                            var questionIndex = $(this).attr('index');
                            if (questionIndex != 0) {
                                $(this).hide();
                            }

                        });
                        $("#rateAssessment").modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
                // Add this code to properly destroy the modal
                $('#rateAssessment').on('hidden.bs.modal', function() {
                    $(this).data('bs.modal', null);
                });
            });

            // ajax function for open assessment question
            $(document).on('click', '.assessment_question', function() {
                const assessment_id = $(this).data('assessment_id');
                const route = $(this).data('route');
                $('#assessmentQuestion').modal('show');
                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        assessment_id: assessment_id,
                    },
                    success: function(response) {
                        $('.questions').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // ajax function to open rate_details for assessment
            $(document).on('click', '.rate_details', function() {
                const rate_id = $(this).data('rate-id');
                const route = $(this).data('route');
                $('#rateDetails').modal('show');
                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        rate_id: rate_id,
                    },
                    success: function(response) {
                        $('.detailss').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // ajax function to render pager after click on
            $(document).on('click', '.renderAssessment', function() {
                const assessment_id = $(this).data('id');
                const title = $(this).data('title');
                const route = $(this).data('route');
                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        assessment_id: assessment_id,
                        title: title,
                    },
                    success: function(response) {
                        $('.render_assessment').empty();
                        $('.render_assessment').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('input[name^="questions"]').on('input', function() {
                var rateInput = $(this);
                var rateValue = rateInput.val();
                if (rateValue < 0 || rateValue > 100) {
                    rateInput.addClass('is-invalid');
                    rateInput.siblings('.error-message').text('The rate must be between 0 and 100.');
                } else {
                    rateInput.removeClass('is-invalid');
                    rateInput.siblings('.error-message').empty();
                }
            });

            $("#submitButton").on('click', function(e) {
                e.preventDefault();

                var data = $("#myForm").serializeArray();

                $.ajax({
                    url: "/assessment/show/update-rate", // replace with your URL
                    type: 'POST',
                    data: data,
                    success: (response) => {
                        location.reload();
                        $('#new_rate').text('Rate : ' + response.newRate.rate + ' %');
                        var rate_id = response.newRate.id;
                        $('.rate_assessment[data-user="' + response.newRate.user_id + '"]')
                            .attr('data-rate', rate_id);
                        $('#kt_modal_create_app').modal('hide');
                        toastr.success("Employee Rate Saved Successfully");
                        $('.rate_assessment[data-user="' + response.newRate.user_id + '"]')
                            .attr('data-rate', rate_id);
                        $('#rate').val(response.newRate.rate);
                        $('#note').val(response.newRate.note);
                    },
                    error: (xhr, status, error) => {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, error) {
                            console.log(key, error);
                            let errorMsg = '<div class="error-msg">' + error[0] +
                                '</div>';
                            $('[name="' + key + '"]').addClass('is-invalid').after(
                                errorMsg);
                        });
                    }
                });
            });
        });
    </script>
@endpush
