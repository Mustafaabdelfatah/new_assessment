@php
    use App\Enums\RateStatusEnums;
    use App\Enums\UsersTypesEnums;
    use App\Models\Position;
    use App\Models\Question;
    use App\Models\Rate;
    use App\Models\Assessment;
    use App\Models\User;use Carbon\Carbon;
@endphp
<div>
    <div class="container-fluid">
        <div class="row">
                @isset($highestRatedEmployee)
                    <div class="col-xl-6 mb-xl-10 mx-auto">
                        <div class="card border-transparent " data-bs-theme="light" style="background-color: #1C325E;">
                            <!--begin::Body-->
                            <div class="card-body d-flex ps-xl-15">
                                <!--begin::Wrapper-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                                    <span class="me-2">
                                        Best Employee
                                    </span>
                                        <div class="mt-2">
                                            {{ $highestRatedEmployee->name }}
                                        </div>
                                    </div>
                                    <!--end::Title-->

                                    <!--begin::Action-->
                                    <div class="mb-3">
                                        <a href="#" class="btn btn-danger fw-semibold me-2" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_upgrade_plan">
                                            {{ number_format($highestRatedEmployee->average_rate,2) }}%
                                        </a>
                                    </div>
                                    <!--begin::Action-->
                                </div>
                                <!--begin::Wrapper-->

                                <!--begin::Illustration-->
                                <img src="{{ asset('assets/media/illustrations/sigma-1/17-dark.png') }}"
                                    class="position-absolute me-3 bottom-0 end-0 h-200px" alt="">
                                <!--end::Illustration-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                @endisset
                @isset($lowesttRatedEmployee)
                    <div class="col-xl-6 mb-xl-10 mx-auto">
                        <div class="card border-transparent " data-bs-theme="light" style="background-color: #1C325E;">
                            <!--begin::Body-->
                            <div class="card-body d-flex ps-xl-15">
                                <!--begin::Wrapper-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                                    <span class="me-2">
                                        Bad Employee
                                    </span>
                                        <div class="mt-2">
                                            {{ $lowesttRatedEmployee->name }}
                                        </div>
                                    </div>
                                    <!--end::Title-->

                                    <!--begin::Action-->
                                    <div class="mb-3">
                                        <a href="#" class="btn btn-danger fw-semibold me-2" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_upgrade_plan">
                                            {{ number_format($lowesttRatedEmployee->average_rate,2) }}%
                                        </a>
                                    </div>
                                    <!--begin::Action-->
                                </div>
                                <!--begin::Wrapper-->

                                <!--begin::Illustration-->
                                <img src="{{ asset('assets/media/illustrations/sigma-1/17-dark.png') }}"
                                    class="position-absolute me-3 bottom-0 end-0 h-200px" alt="">
                                <!--end::Illustration-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                @endisset
        </div>
        <div class="row">
            <div class="col-xl-4 mb-xl-10">
                <div class="card card-flush h-xl-100">
                    <div
                        class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                        style="background-image:url('https://preview.keenthemes.com/metronic8/demo41/assets/media/svg/shapes/top-green.png')"
                        data-bs-theme="light">
                        <h3 class="card-title align-items-start flex-column text-white pt-15">
                            <span class="fw-bold fs-2x mb-3">Statistics</span>

                            <div class="fs-4 text-white">
                                <span class="opacity-75">You have</span>

                                <span class="position-relative d-inline-block">
                                    <a href="#"
                                       class="link-white opacity-75-hover fw-bold d-block mb-1"></a>

                                    <span
                                        class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                </span>
                            </div>
                        </h3>
                    </div>
                    <div class="card-body mt-n20">
                        <div class="mt-n20 position-relative">
                            <div class="row g-3 g-lg-6">
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    {{-- <i class="fas fa-layer-group fs-2x"></i> --}}
                                                    <img src="{{ asset('icons/leadership.png') }}" style="width: 26px"
                                                         alt="">
                                                </span>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span
                                                class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ Position::count() }}</span>
                                            <span class="text-gray-500 fw-semibold fs-6">Positions</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    <img src="{{ asset('icons/group.png') }}" style="width: 26px"
                                                         alt="">
                                                </span>
                                            </span>
                                        </div>

                                        <div class="m-0">
                                            <span
                                                class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ User::where(['type' => UsersTypesEnums::EMPLOYEE])->count() }}</span>
                                            <span class="text-gray-500 fw-semibold fs-6">Employees</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    <img src="{{ asset('icons/question.png') }}" style="width: 26px"
                                                         alt="">
                                                </span>
                                            </span>
                                        </div>

                                        <div class="m-0">
                                            <span
                                                class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ Question::count() }}</span>

                                            <span class="text-gray-500 fw-semibold fs-6">Question</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    <img src="{{ asset('icons/evaluation.png') }}" style="width: 26px"
                                                         alt="">
                                                </span>
                                            </span>
                                        </div>

                                        <div class="m-0">
                                            <span
                                                class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{ Assessment::where('status', 'active')->count() }}</span>
                                            <span class="text-gray-500 fw-semibold fs-6">Published Assessment</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @isset($highestAvgRates)
                <div class="col-xl-4 mb-xl-10">
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7 d-block">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <h2 class="  text-gray-800 me-2 lh-1 ls-n2 mb-5">Highest And Below Rate In Specific Assessment
                                    </h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <label for="select-group">Select Type</label>

                                        <select class="form-control nice-select select_group" id="select-group">
                                            @foreach($getAssessSlugs as $group )
                                                <option
                                                    value="{{ $group }}" {{ $loop->first ? 'selected' : '' }}>{{ ucfirst(str_replace('-',' ',$group)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="select-group">Select Date</label>
                                        <select class="form-select select_2" id="select-group-date" multiple>
                                            <option value="all">All</option>
                                            @foreach($getAssessDates as $date )
                                                <option
                                                    value="{{ Carbon::parse($date)->format('Y-m-d') }}" {{ $loop->last ? 'selected' : '' }}>{{ Carbon::parse($date)->format('Y-m-d') }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <label for="select-group">Select Employees to send</label>
                                        <select class="form-select select_2" id="-group-date" multiple>
                                            <option value="all">All</option>
                                            @foreach($users as $user )
                                                <option
                                                    value="{{ $user->id }}" >{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 text-end mt-4">
                                        <button class="btn btn-primary">Send</button>
                                    </div>
                                </div>

                                <!--end::Description-->
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-1">
                            <div class="min-h-auto highestSection mt-5">

                            </div>

                            <div class="min-h-auto lowestSection mt-5">

                            </div>


                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            @endisset
            {{-- @isset($highestAvgRates) --}}
            <div class="col-xl-4 mb-xl-10">
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header py-7 d-block">
                        <!--begin::Statistics-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Title-->
                                <h2 class=" text-gray-800 me-2 lh-1 ls-n2 mb-5">Highest And Below Rate In All System</h2>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="select-group">Select Date</label>
                                    <select class="form-select select_2" id="select-group-date-second" multiple>
                                        <option value="all">All</option>
                                        @for ($month = 1; $month <= 12; $month++)
                                            @php
                                                $date = \Carbon\Carbon::create(null, $month, 1);
                                            @endphp

                                            <option value="{{ Carbon::parse($date)->format('Y-m-d') }}">{{ $date->format('d - F - Y') }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!--end::Description-->
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-1">
                        <div class="min-h-auto highestSectionAll mt-5">

                        </div>

                        <div class="min-h-auto lowestSectionAll mt-5">

                        </div>


                    </div>
                    <!--end::Body-->
                </div>
            </div>
            {{-- @endisset --}}
            @isset($highestAvgRates)
                <div class="col-xl-4 mb-xl-10">
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7 d-block">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 mb-5">Highest & Lowest Rate Last 3 Months</span>
                                </div>

                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-1">
                            <div id="chart">
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($highestAvgRates)
                <div class="col-xl-4 mb-xl-10">
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7 d-block">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 mb-5">Highest & Lowest Rate Last 3 Months</span>
                                </div>

                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-1">
                            <div id="chart2">
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        var options = {
            series: [{
                data: [98.5, 90.2, 85],
                name: ['mustafa salama']
            }, {
                data: [60, 70, 75],
                name: ['hassan elhawary']
            }],
            chart: {
                type: 'bar',
                height: 430
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                offsetX: -6,
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                }
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['#fff']
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            xaxis: {
                categories: ['Mar', "apr", 'May'],
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        var options = {
            series: [{
                name: 'Mustafa Salama',
                data: [80, 50, 30, 40, 100, 20],
            }, {
                name: 'Hassan Elhawary',
                data: [20, 30, 40, 80, 20, 80],
            }, {
                name: 'Hamid Blabel',
                data: [44, 76, 78, 13, 43, 10],
            }],
            chart: {
                height: 350,
                type: 'radar',
                dropShadow: {
                    enabled: true,
                    blur: 1,
                    left: 1,
                    top: 1
                }
            },
            title: {
                text: 'Radar Chart - Multi Series'
            },
            stroke: {
                width: 2
            },
            fill: {
                opacity: 0.1
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: ['Mar', 'Apr', 'May']
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();


    </script>
    <script>
        $(document).ready(function (string) {
            $('.select_group').change(function (e) {
                e.preventDefault();
                let itemVal = $(this).val();
                $.ajax({
                    url: '{{ url('/get-dates') }}',
                    type: 'GET',
                    data: {
                        "slug": itemVal,
                    },
                    dataType: 'json',
                    success: function (res) {
                        let selectDate = $('#select-group-date');
                        selectDate.empty();
                        selectDate.append('<option value="all">Select All</option>');
                        $.each(res.data, function (key, value) {
                            selectDate.append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                });
            });


            $('#select-group-date').change(function (e) {
                e.preventDefault();
                let itemVal = $(this).val();
                let slug = $('.select_group').val();

                $.ajax({
                    url: '{{ url('/get-emp') }}',
                    type: 'GET',
                    data: {
                        "dates": itemVal,
                        "slug": slug
                    },
                    dataType: 'json',
                    success: function (res) {
                        let highest = res.data.highest;
                        let lowest = res.data.lowest;
                        let highestSection = $('.highestSection');
                        highestSection.empty();
                        $.each(highest, function (key, value) {
                            highestSection.append(`<div class="py-1 px-4 mt-2"><span class="fw-bold">${value.name}</span><div class=" empStateTop mt-2 position-relative" ><div  class="userGreen py-1   text-center text-white" style="width:${(parseFloat(value.avg_rate, 2))}%"></div> <span class="avgUser position-absolute">${(parseFloat(value.avg_rate, 2))}%</span></div></div>`);
                        });

                        let lowestSection = $('.lowestSection');
                        lowestSection.empty();
                        $.each(lowest, function (key, value) {
                            highestSection.append(`<div class="py-1 px-4 mt-2"> <span class="fw-bold">${value.name}</span><div class=" empStateDanger mt-2 position-relative" ><div class="bg-danger  py-1  text-center text-white" style="width:${(parseFloat(value.avg_rate, 2))}%"></div> <span class="avgUser position-absolute">${(parseFloat(value.avg_rate, 2))}%</span></div></div>`);
                        });

                    }
                });
            });
            $('#select-group-date').trigger('change');
            $('#select-group-date-second').change(function (e) {
                e.preventDefault();
                let itemVal = $(this).val();

                $.ajax({
                    url: '{{ url('/get-emp-all') }}',
                    type: 'GET',
                    data: {
                        "dates": itemVal,
                    },
                    dataType: 'json',
                    success: function (res) {
                        let highest = res.data.highest;
                        let lowest = res.data.lowest;
                        let highestSection = $('.highestSectionAll');
                        highestSection.empty();
                        $.each(highest, function (key, value) {
                            highestSection.append(`<div class="py-1 px-4 mt-2"><span class="fw-bold">${value.name}</span><div class=" empStateTop mt-2 position-relative" ><div  class="userGreen py-1   text-center text-white" style="width:${(parseFloat(value.avg_rate, 2))}%"></div> <span class="avgUser position-absolute">${(parseFloat(value.avg_rate, 2))}%</span></div></div>`);
                        });
                        let lowestSection = $('.lowestSectionAll');
                        lowestSection.empty();
                        $.each(lowest, function (key, value) {
                            highestSection.append(`<div class="py-1 px-4 mt-2"> <span class="fw-bold">${value.name}</span><div class=" empStateDanger mt-2 position-relative" ><div class="bg-danger  py-1  text-center text-white" style="width:${(parseFloat(value.avg_rate, 2))}%"></div> <span class="avgUser position-absolute">${(parseFloat(value.avg_rate, 2))}%</span></div></div>`);
                        });
                    }
                });
            });
        });
    </script>
@endpush
@push('css')
    <style>
        .empStateTop {
            border: 1px solid #00b37d;
            border-radius: 5px;

        }

        .empStateDanger {
            border: 1px solid var(--bs-danger) !important;
            border-radius: 5px;

        }

        .avgUser {
            right: 8px;
            z-index: 1;
            top: 5px;
            font-weight: bold;
        }

        .userGreen {
            background-color: #00b37d;
            border-radius: 5px;

        }
    </style>
@endpush
