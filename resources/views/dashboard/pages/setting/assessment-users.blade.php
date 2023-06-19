@php use Carbon\Carbon; @endphp
@extends('app')

@section('title', 'Assessments Rated / unrated')

@section('content')
    <div class="card  mb-8">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {{ Carbon::parse($month)->format('Y F') }}
                </div>
            </div>


        </div>

        <div class="card-body py-4">
            @foreach($assessmentsDates as $assessmentsDate)
                <a class="d-inline-block mx-2 btn btn-secondary " style="{{ Carbon::parse($month)->format('Y-m') == Carbon::parse($assessmentsDate)->format('Y-m') ? 'background:#6eaf26 !important;color:#fff' : ''  }}"
                   href="{{ url('rated_users/'.Carbon::parse($assessmentsDate)->format('Y-m'))  }}">{{ Carbon::parse($assessmentsDate)->format('Y F') }}</a>
            @endforeach
        </div>

    </div>


    <div class="card">
        <!--begin::Card header-->

        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    Rated Employees
                </div>
            </div>
        </div>
        <!--end::Card header-->
        <button class="btn btn-light btn-active-light-primary btn-sm"
            style="position: absolute;right: 27px;top:20px">

            <a href="{{ route('admin.export-rates', ['month' => Carbon::parse($month)->format('Y-m')]) }}">Export Excel</a>

        </button>

        <!--begin::Card body-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" hidden type="checkbox" data-kt-check="true"
                                   data-kt-check-target="#kt_datatable .form-check-input" value="0"/>
                        </div>
                    </th>
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Manager Name</th>
                    <th class="min-w-125px">Assessment Title</th>
                    <th class="min-w-125px">Rate</th>
                 </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">
                @foreach($RatedUsers as $rateUser)
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
                            {{ $rateUser?->rateUser->rate}} %
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="card mt-8">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    Un Rated Employees
                </div>
            </div>

        </div>
        <!--end::Card header-->
        <button class="btn btn-light btn-active-light-primary btn-sm"
        style="position: absolute;right: 27px;top:20px">
        <a href="{{ route('admin.export-unrated', ['month' => Carbon::parse($month)->format('Y-m')]) }}">Export Excel</a>
        </button>
        <!--begin::Card body-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" hidden type="checkbox" data-kt-check="true"
                                   data-kt-check-target="#kt_datatable .form-check-input" value="0"/>
                        </div>
                    </th>
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Manager Name</th>
                    <th class="min-w-125px">Assessment Title</th>
                 </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">

                @foreach($unRatedUsers as $UnrateUser)
                    <tr id="row-{{ $UnrateUser->id }}">
                        <td></td>
                        <td class="name" data-field="name">
                            {{ $UnrateUser?->user->name }}
                        </td>

                        <td class="name" data-field="name">
                            {{ $UnrateUser?->assessment?->manager->name }}
                        </td>

                        <td class="name" data-field="name">
                            {{ $UnrateUser?->assessment?->title }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('js')
    <!-- jQuery library -->

    <script src="{{asset('assets/js/crud/table.js')}}"></script>
    <script src="{{asset('assets/js/crud/add.js')}}"></script>
    <script src="{{asset('assets/js/crud/edit.js')}}"></script>
    <script src="{{asset('assets/js/crud/delete.js')}}"></script>
@endpush

