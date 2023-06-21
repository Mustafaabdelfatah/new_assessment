@extends('app')
@section('title', 'Details')
@push('css')
    <link href="{{ asset('assets/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')

    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <!--end::Details-->
        @if ($first_month)
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table widget 9-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">First Month ({{ $first_month->rate }} %)</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive" style="min-height:300px !important">
                            <!--begin::Table-->
                            <table class="table table-row-dashed align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fs-7 fw-bold border-0 text-gray-400">
                                        <th class="min-w-150px" colspan="2">Question</th>
                                        <th class="min-w-150px text-end pe-0" colspan="2">Degree</th>
                                        <th class="text-end min-w-150px" colspan="2">Assessment Name</th>
                                        <th class="text-end min-w-150px" colspan="2">Assessment Date</th>
                                        <th class="text-end min-w-150px" colspan="2">Manager Name</th>
                                        <th class="text-end min-w-150px" colspan="2">Manager Note</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->

                                {{-- @dd($rate/) --}}
                                @foreach ($first_month->answers as $answer)
                                    <tbody>
                                        <tr>
                                            <td class="" colspan="2">
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $answer->question?->title }}</a>
                                            </td>

                                            <td class="pe-0" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="{{ $answer->rate > 50 ? 'text-success' : 'text-danger' }} fw-bold fs-6 me-1">
                                                        {{ number_format($answer->rate) }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $first_month->assessment->title }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $first_month->date }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $first_month->manager->name }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $answer->note }}</span>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                @endforeach

                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Table Widget 9-->
            </div>
        @endif
        {{-- @dd($second_month) --}}
        @if ($second_month)
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table widget 9-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Second Month ({{ $second_month->rate }} %)</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive" style="min-height:300px !important">
                            <!--begin::Table-->
                            <table class="table table-row-dashed align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fs-7 fw-bold border-0 text-gray-400">
                                        <th class="min-w-150px" colspan="2">Question</th>
                                        <th class="min-w-150px text-end pe-0" colspan="2">Degree</th>
                                        <th class="text-end min-w-150px" colspan="2">Assessment Name</th>
                                        <th class="text-end min-w-150px" colspan="2">Assessment Date</th>
                                        <th class="text-end min-w-150px" colspan="2">Manager Name</th>
                                        <th class="text-end min-w-150px" colspan="2">Manager Note</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                {{-- @foreach ($second_month as $rate) --}}
                                {{-- @dd($rate/) --}}
                                @foreach ($second_month->answers as $answer)
                                    <tbody>
                                        <tr>
                                            <td class="" colspan="2">
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $answer->question?->title }}</a>
                                            </td>

                                            <td class="pe-0" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="{{ $answer->rate > 50 ? 'text-success' : 'text-danger' }} fw-bold fs-6 me-1">
                                                        {{ number_format($answer->rate) }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $second_month->assessment->title }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $second_month->date }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $second_month->manager->name }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $answer->note }}</span>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                @endforeach
                                {{-- @endforeach --}}
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Table Widget 9-->
            </div>
        @endif
        @if ($third_month)
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table widget 9-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Third Month ({{ $third_month->rate }} %)</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive" style="min-height:300px !important">
                            <!--begin::Table-->
                            <table class="table table-row-dashed align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fs-7 fw-bold border-0 text-gray-400">
                                        <th class="min-w-150px" colspan="2">Question</th>
                                        <th class="min-w-150px text-end pe-0" colspan="2">Degree</th>
                                        <th class="text-end min-w-150px" colspan="2">Assessment Name</th>
                                        <th class="text-end min-w-150px" colspan="2">Assessment Date</th>
                                        <th class="text-end min-w-150px" colspan="2">Manager Name</th>
                                        <th class="text-end min-w-150px" colspan="2">Manager Note</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->

                                {{-- @dd($rate/) --}}
                                @foreach ($third_month->answers as $answer)
                                    <tbody>
                                        <tr>
                                            <td class="" colspan="2">
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $answer->question?->title }}</a>
                                            </td>

                                            <td class="pe-0" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="{{ $answer->rate > 50 ? 'text-success' : 'text-danger' }} fw-bold fs-6 me-1">
                                                        {{ number_format($answer->rate) }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $third_month->assessment->title }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $third_month->date }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $third_month->manager->name }}</span>
                                                </div>
                                            </td>

                                            <td class="" colspan="2">
                                                <div class="d-flex justify-content-end">

                                                    <span
                                                        class="text-gray-800  min-w-60px d-block text-end fw-bold fs-6">{{ $answer->note }}</span>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                @endforeach
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Table Widget 9-->
            </div>
        @endif


    </div>

@endsection

@push('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endpush
