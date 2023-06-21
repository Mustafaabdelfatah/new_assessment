@extends('app')
@section('title', 'User Rates')
@push('css')
<link href="{{ asset('assets/select2.min.css')}}" rel="stylesheet" type="text/css"/>

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endpush
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    User Rate History
                </div>
                <button class="btn btn-light btn-active-light-primary btn-sm"
                    style="
                position: absolute;
                right: 27px;
            ">
                    <a href="{{ route('admin.export-rates', $id) }}">export excel</a>
                </button>
                <!--end::Search-->
            </div>
        </div>
        <!--end::Card header-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                    <th class="min-w-125px">Employee Name</th>
                    <th class="min-w-125px">Total Rate</th>
                    <th class="min-w-125px">Assessment Manager</th>
                    <th class="min-w-125px">Assessment Name</th>
                    <th class="min-w-125px">Assessment Type</th>
                    <th class="min-w-125px">Assessment Date</th>

                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">
                @foreach ($rates as $rate)
                    <tr  >
                        <td >{{ $rate?->user?->name }} - {{$rate?->user?->position?->title}}</td>
                        <td >{{ $rate?->rate }}%</td>
                        <td >{{ $rate?->assessment?->manager?->name }} - {{ $rate?->assessment?->manager?->position?->title }}</td>
                        <td >{{ $rate->assessment->title }}</td>
                        <td >{{ $rate->assessment->type }}</td>
                        <td >{{ $rate->assessment->start_date->format('F Y') }}</td>
                    </tr>
                @endforeach
                {{-- @foreach($rates as $rate)
                    <tr id="row-{{ $rate->id }}">
                        <td></td>
                        <td class="name" data-field="name">
                            {{$rate?->name}}
                        </td>
                        <td class="assessment_count" data-field="assessment_count">
                            {{$rate?->assessment_count}}
                        </td>
                        <td class="assessment_names" data-field="assessment_names">
                        @php
                            $counter = 0;
                            $assessments = explode(',', $rate->assessment_names);
                        @endphp
                        @foreach (array_slice($assessments, 0, 3) as $assessment)
                            <span class="badge badge-info">{{ $assessment }}</span>
                            @php $counter++; @endphp
                        @endforeach
                          <br>
                        @foreach (array_slice($assessments, 3) as $assessment)
                            <span class="badge badge-info">{{ $assessment }}</span>
                            @php
                              $counter++;
                              if ($counter % 3 == 0) echo "<br>";
                            @endphp
                        @endforeach
                        </td>
                    </tr>
                @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endpush
