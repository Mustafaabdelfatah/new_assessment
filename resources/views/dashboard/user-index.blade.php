@php use Carbon\Carbon; @endphp
<div class="card mb-5 mb-xxl-8">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol profile-image-container symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img id="profile-image" src="{{ asset($user_data?->image_path) }}" alt="image" />
                    <div class="edit-icon" onclick="document.getElementById('profile-image').click();">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <div
                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                    </div>
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#"
                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user_data->name }}</a>
                            <a href="#">
                                {{--
                                <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                --}}
                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                            fill="currentColor" />
                                        <path
                                            d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                            fill="white" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Name-->
                        {{--
                        <!--begin::Info-->
                        --}}
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#"
                                class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                                            fill="currentColor" />
                                        <path
                                            d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                                            fill="currentColor" />
                                        <rect x="7" y="6" width="4" height="4" rx="2"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                {{ $user_data->position->title }}
                            </a>
                            {{-- @dd($user->teams) --}}
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3"
                                            d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                            fill="currentColor" />
                                        <path
                                            d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                {{ $user_data->email }}
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                    <!--begin::Actions-->
                </div>
                <!--end::Title-->
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->AssessmentManager()->count() >= 1)
    <div class="card ">
        <!--begin::Card header-->

        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    Rated Employees - {{ Carbon::parse($month)->format('Y F') }}
                </div>


            </div>
            <div class="mt-4">
                @foreach ($assessmentsDates as $assessmentsDate)
                    <a class="d-inline-block mx-2 btn btn-secondary "
                        style="{{ Carbon::parse($month)->format('Y-m') == Carbon::parse($assessmentsDate)->format('Y-m') ? 'background:#6eaf26 !important;color:#fff' : '' }}"
                        href="{{ url('/' . Carbon::parse($assessmentsDate)->format('Y-m')) }}">{{ Carbon::parse($assessmentsDate)->format('Y F') }}</a>
                @endforeach
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" hidden type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_datatable .form-check-input" value="0" />
                            </div>
                        </th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Manager Name</th>
                        <th class="min-w-125px">Assessment Title</th>
                        <th class="min-w-125px">Rate</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">
                    @foreach ($RatedUsers as $rateUser)
                        <tr id="row-{{ $rateUser->id }}">
                            <td></td>
                            <td class="name" data-field="name">
                                {{ $rateUser?->user->name }}
                            </td>
                            <td class="name" data-field="name">
                                {{ $rateUser?->assessment->manager->name }}
                            </td>

                            <td class="name" data-field="name">
                                {{ $rateUser?->assessment?->title }}
                            </td>
                            <td class="name" data-field="name">
                                {{ $rateUser?->rate }} %
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endif


@if (!$firstQuarter->isEmpty())
    <div class="d-flex flex-wrap flex-stack mb-6">
        <!--begin::Title-->
        <h3 class="fw-bold my-2">
            First Quarter Of Year
            <span class="fs-6 text-gray-400 fw-semibold ms-1">(From January 1 To March 31)</span>
        </h3>
        <!--end::Title-->
    </div>
    <div class="row g-6 g-xl-9">
        <!--begin::Col-->
        @foreach ($firstQuarter as $firstQuarter)
            <div class="col-sm-6 col-xl-4">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card header-->
                    <div class="card-header flex-nowrap border-0 pt-9">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <span class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0"> Avg Rate In
                                {{ $firstQuarter->slug }} </span>
                            <!--end::Title-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar m-0">
                            <!--begin::Menu-->
                            <button type="button"
                                class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                {{-- <i class="ki-outline ki-element-plus fs-3 text-primary"></i> --}}
                            </button>
                            <!--begin::Menu 3-->

                            <!--end::Menu 3-->
                            <!--end::Menu-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                        <!--begin::Heading-->
                        <div class="fs-2tx fw-bold mb-3">
                            {{ number_format($firstQuarter->average_rate, 2) }} %
                        </div>
                        <!--end::Heading-->
                        <!--begin::Stats-->
                        {{-- @dd($userId) --}}
                        <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
                            <i class="ki-outline ki-Up-right fs-3 me-1 text-danger"></i>
                            <!--begin::Number-->
                            <div class="fw-bold text-danger me-2">
                                <a href="{{ route('admin.rate.details', ['assessment' => $firstQuarter->slug, 'startdate' => 'January 1', 'enddate' => 'March 31', 'userid' => $userId]) }}"
                                    class="btn btn-primary btn-sm">Rate Details</a>
                            </div>
                            <!--end::Number-->
                        </div>
                        <!--end::Stats-->
                        <!--begin::Indicator-->

                        <!--end::Indicator-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
        @endforeach
    </div>

@endif

@if (auth()->user()->AssessmentManager()->count() >= 1)
    <div class="card mt-8">
        <!--begin::Card header-->

        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    Employees Avg
                </div>
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div id="empChart"></div>
        </div>
    </div>
@endif

<div class="col-xl-12 mb-xl-10  " style="margin-top: 20px">
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header py-7 d-block">
            <!--begin::Statistics-->
            <div class="m-0">
                <!--begin::Heading-->
                <div class="d-flex align-items-center mb-2">
                </div>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body pt-0 pb-1">
            <div id="chart-container"></div>

        </div>
    </div>
</div>
{{-- @dd($assessmentData, json_encode($assessmentData)) --}}
<script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
<script>
    @php
        // Check if $assessmentData variable is defined
        if (!isset($assessmentData)) {
            $assessmentData = [];
        }
    @endphp

    // Get the assessment data from the PHP variable
    var assessmentData = {!! json_encode($assessmentData) !!};

    // Function to update the chart
    function updateChart(assessmentData) {
        // Extract assessments and series from assessmentData
        let assessments = assessmentData.map(assessment => assessment.title);
        let series = assessmentData.map(assessment => {
            return {
                name: assessment.title,
                data: assessment.rates
            };
        });

        // Chart rendering logic using ApexCharts library
        var options = {
            chart: {
                type: 'line',
                height: 400
            },
            series: series,
            xaxis: {
                categories: assessments
            },
            stroke: {
                curve: 'smooth' // Set curve to 'smooth' for a basic curve
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-container"), options);
        chart.render();
    }

    // Call the updateChart function with the assessmentData
    updateChart(assessmentData);
</script>

@push('js')
    <script>
        $(document).ready(function() {
            var options = {
                series: [{
                    name: "Rate",
                    data: @json($empRates)
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Employees Average Rates',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: @json($empNames),
                }
            };

            let chart = new ApexCharts(document.querySelector("#empChart"), options);
            chart.render();


        });
    </script>
@endpush
