@extends('app')
@section('title', 'Assessment')
@section('content')
@checkAdmin
<div class="card">
   <!--begin::Card header-->
   <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
         <div class="d-flex align-items-center position-relative my-1">
            {{-- <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i> --}}
            <input type="text" data-kt-datatable-filter="search"
               class="form-control form-control-solid w-250px ps-13" placeholder="Search Assessment"/>
         </div>
      </div>
      <!--begin::Card title-->
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
         <div class="d-flex justify-content-end" data-kt-assessment-table-toolbar="base">
            <button type="button" class="btn btn-primary"
                onclick="firemodal('#kt_modal_add')">  Add Assessment
            </button>
         </div>
      </div>
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
               <th class="min-w-125px">Title</th>
               <th class="min-w-125px">Type</th>
               <th class="min-w-125px">Start Date</th>
               <th class="min-w-125px">End Date</th>
               <th class="min-w-125px">Status</th>
               <th class="min-w-125px">Manager Name</th>
               <th class="min-w-125px">Data Created</th>
               <th class="text-end min-w-100px">Actions</th>
            </tr>
         </thead>
         <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">
            @foreach($assessments as $assessment)
            <tr id="row-{{ $assessment->id }}">
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
                  <img src="{{asset('icons/view.png')}}" class="action_icon" style="height:20px" alt="">
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
                  <img src="{{asset('icons/question-mark.png')}}" class="action_icon" style="height:20px" alt="">
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
                  <img src="{{asset('icons/trash.png')}}" alt="" class="action_icon"  >
                  </button>
                  @endcheckAdmin
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
{{-- Edit Assessment --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered mw-650px">
      <div class="modal-content">
         <div class="modal-header" id="edit-modal_header">
            <h2 class="fw-bold">Edit assessment</h2>
            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-modal-action="close">
               <i class="ki-outline ki-cross fs-1"></i>
            </div>
         </div>
         <!--begin::Modal body-->
         <div class="modal-body edit-body scroll-y mx-5 mx-xl-15 my-7">
         </div>
      </div>
   </div>
</div>
@include('dashboard.pages.assessment.create')
@include('dashboard.pages.assessment.assign-question')
@else
<div class="row g-6 g-xl-9">
   <!--begin::Col-->
   @foreach ($assessments as $assessment )

   <div class="col-md-6 col-xl-4">
    <!--begin::Card-->
    <div   class="card border-hover-primary ">
       <!--begin::Card header-->
       <div class="card-header border-0 pt-9">
          <!--begin::Card Title-->
          <div class="card-title m-0">
             <!--begin::Avatar-->
             <div class="symbol symbol-50px w-50px bg-light">
                <span class="badge badge-light-primary fw-bold me-auto px-4 py-3" style="text-transform: capitalize">{{$assessment->status}}</span>
              </div>
             <!--end::Avatar-->
          </div>
          <!--end::Car Title-->
          <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <a href="{{ url('assessment/show/' .$assessment->id. '/'. $assessment->title) }}" class="badge badge-primary fw-bold me-auto px-4 py-3">Make Rate</a>
        </div>
          <!--end::Card toolbar-->
       </div>
       <!--end:: Card header-->
       <!--begin:: Card body-->
       <div class="card-body p-9">
          <!--begin::Name-->

          <div class="fs-3 fw-bold text-dark mb-5">
             {{$assessment->title }}
          </div>

          <!--end::Name-->
          <!--begin::Description-->
          {{-- <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">
            Pending Assessment :
            @foreach($PendingAssessment as $date)
            <span class="badge badge-danger">
                {{$date}}
            </span>
            @endforeach

          </p> --}}
          <!--end::Description-->
          <!--begin::Info-->
          <div class="d-flex flex-wrap mb-5">
             <!--begin::Due-->
             <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                <div class="fs-6 text-gray-800 fw-bold">{{$assessment->users_count}}</div>
                <div class="fw-semibold text-gray-400">Users Count</div>
             </div>
             <!--end::Due-->
             <!--begin::Budget-->
             <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                <div class="fs-6 text-gray-800 fw-bold">{{$assessment->questions_count}}</div>
                <div class="fw-semibold text-gray-400">Questions Count</div>
             </div>
             <!--end::Budget-->
          </div>
          <!--end::Info-->
          <!--begin::Progress-->
          <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" aria-label="This project 50% completed" data-bs-original-title="This project 50% completed" data-kt-initialized="1">
             <div class="bg-primary rounded h-4px" role="progressbar" style="width: {{$assessment->percentage_rated}}%" aria-valuenow=" 50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <!--end::Progress-->
          <!--begin::Users-->
          <div class="symbol-group symbol-hover">
            @foreach($assessment->users->take(3) as $user)
            <!--begin::User-->
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="{{ $user->name }}" data-bs-original-title="{{ $user->name }}" data-kt-initialized="1">
               <img alt="{{ $user->name }}" src="{{ $user->image_path }}">
            </div>
            <!--end::User-->
            @endforeach
          </div>

          <!--end::Users-->
       </div>
       <!--end:: Card body-->
    </div>
    <!--end::Card-->
 </div>
   @endforeach

   <!--end::Col-->
</div>
<!--Begin Alert Modal-->
@include('dashboard.pages.assessment.alert_modal')
<!--End Alert Modal-->
@endcheckAdmin
@endsection
@push('js')
<script>
   $(document).ready(function() {

       // open Alert modal and assign assessment_id to action
       var modalDisplayed = sessionStorage.getItem('modalDisplayed');

       if (modalDisplayed === null) {
           $("#AlertModal").modal('show');
           sessionStorage.setItem('modalDisplayed', 'true');
       }
       var progressBar = $(".progress-bar");
       var progress = 0;
       var intervalId = setInterval(function () {
           progress += 10;
           progressBar.width(progress + "%");
           if (progress >= 100) {
               clearInterval(intervalId);

               $("#AlertModal").modal('hide');
           }
       }, 400);

      // open modal and assign assessment_id to action
      $('.assign-question-button').on('click', function() {
          var assessmentId = $(this).data('id');
          var url = "{{ route('admin.assessment.assign', ':id') }}".replace(':id', assessmentId);
          $('#assign-question-form').attr('action', url  );
          $('#assessment_id').attr('value',assessmentId );
          $('#assign-question-modal').modal('show');
      });

      // when choose category get all questions depend ...
      $('#category_id').on('change', function() {
          var categoryId = $(this).val();
          if (categoryId) {
              $.ajax({
              url: '/assign-questions-by-category/' + categoryId,
              type: 'GET',
              dataType: 'json',
              success: function(data) {
                  $('#question_id').empty();
                  $.each(data, function(key, value) {
                  $('#question_id').append('<option value="' + key + '">' + value + '</option>');
                  });
              }
              });
          }else {
              $('#question_id').empty();
          }
      });

      // assign questions to assessment (post)
      $('#assign-question-form').submit(function(e) {
          e.preventDefault(); // prevent the form from submitting normally
          var formData = $(this).serialize(); // serialize the form data
          var url = $(this).attr('action'); // get the form action URL
          $.ajax({
              type: 'POST',
              url: url,
              data: formData,
              success: function(response) {
                  var editedRow = $('#kt_datatable_body').find('tr[id="row-' + response.assessment.id + '"]');
                  editedRow.find('td[data-field="status"] span').removeClass('badge badge-warning').addClass('badge badge-success').text(response.assessment.status);
                  toastr.success("Question Assigned Successfully.");
                  $('#assign-question-modal').modal('hide');
                  $('.nice-select').val([]).trigger('change');
                  $('#question-error').text('');
              },
              error: function(xhr) {
                  if (xhr.status === 422) {
                      var errors = xhr.responseJSON.errors;
                      if (errors.question_id) {
                      // display the error message
                      $('#question-error').text(errors.question_id[0]);
                      }
                  }
                  // handle the error response from the server
              }
          });
      });

    });


</script>
<script src="{{asset('assets/js/crud/table.js')}}"></script>
<script src="{{asset('assets/js/crud/add.js')}}"></script>
<script src="{{asset('assets/js/crud/edit.js')}}"></script>
<script src="{{asset('assets/js/crud/delete.js')}}"></script>
@endpush
