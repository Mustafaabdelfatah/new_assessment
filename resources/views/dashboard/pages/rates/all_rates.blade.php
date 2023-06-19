@extends('app')
@section('title', 'Rate')
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                    <input type="text" data-kt-datatable-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Rate"/>
                </div>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
        </div>
        <!--end::Card header-->
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
                    <th class="min-w-125px">Employee Name</th>
                    <th class="min-w-125px">Assessment Count</th>
                    <th class="min-w-125px">Assessment Name</th>

                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">

                @foreach($rates as $rate)
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
                        <td class="text-end">
                            <a href="{{ url('rate/history/' . $rate->id) }}" title="Rate History" class="btn btn-icon assign-button btn-active-light-primary w-30px h-30px">
                                <img src="{{asset('icons/eye.png')}}" style="width: 20px;height:20px" alt="">
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/js/crud/table.js')}}"></script>
@endpush


