<form id="edit-form"  class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route("admin.assessments.update",$assessment->id)}}" method="POST" data-method="PUT" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="id" id="row_id" value="{{$assessment->id}}">
    <div
        class="d-flex flex-column scroll-y me-n7 pe-7"
        data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}"
        data-kt-scroll-max-height="auto"
        data-kt-scroll-offset="300px"
        style="min-height: 300px;"
    >
        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-semibold fs-6 mb-2"> Title</label>
            <input type="text" id="title" value="{{$assessment->title}}" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title"  />
         </div>

         <div class="fv-row mb-7 fv-plugins-icon-container" >
            <label class="required fw-semibold fs-6 mb-2">Type</label>
            <select name="type" class="form-control nice-select select3" id="type">
                <option value="monthly" {{$assessment->type== "monthly" ? 'selected':'' }} > Monthly</option>
                <option value="three_month" {{$assessment->type== "three_month" ? 'selected':'' }}>Three Month</option>
                <option value="six_month" {{$assessment->type== "six_month" ? 'selected':'' }}>Six Month</option>
                <option value="1_year" {{$assessment->type== "1_year" ? 'selected':'' }}>1 Year</option>
            </select>
        </div>
        <div class="fv-row mb-7 fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">Start Date</label>
            <!--end::Label-->
            <!--begin::select-->
            <select name="start_date" class="form-control nice-select select3" id="">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i . '-' . $year }}" {{ $i == $month ? 'selected' : '' }}>{{ $i . '-' . $year }}</option>
                @endfor
            </select>
            <!--end::select-->
        </div>

        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-semibold fs-6 mb-2">Select Position</label>
            <select name="position_id" class="form-control nice-select select3" id="position_id">
                <option value="">Select Position</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{$assessment->manager->position_id == $position->id ? "selected" : ''}} >{{ $position->title }} </option>
                 @endforeach
            </select>
        </div>

        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-semibold fs-6 mb-2">Select Manager</label>
            <select name="manager_id" class="form-control nice-select select3" id="manager_id">
                <option value="{{ $assessment->manager->id }}" >{{  $assessment->manager->name }} </option>
            </select>
        </div>
        <div class="fv-row mb-7 fv-plugins-icon-container assess_employee" >
            <!--begin::Label-->
            <label class="required fw-semibold fs-6 mb-2">Employee</label>
            <!--end::Label-->
            <!--begin::select-->

            <select name="employee_ids[]" class="form-control select3" id="employee_ids" multiple>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{$assessment->users->contains($user->id) ? 'selected' : ''}}>{{ $user->name }}</option>
                @endforeach

            </select>

            <!--end::select-->
        </div>
    </div>

    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-kt-modal-action="cancel">
            Discard
        </button>
        <button type="submit" class="btn btn-primary" id="edit-form-submit" data-kt-modal-action="submit">
            <span class="indicator-label">
                Submit
            </span>
            <span class="indicator-progress"> Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span> </span>
        </button>
    </div>
</form>


<script src="{{ asset('assets/select2.min.js')}}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script>
    $(function() {
        $('.select3').select2({
            minimumResultsForSearch: -1
        });

        $('#position_id').on('change', function() {
            var positionId = $(this).val();
            getAssessManagerByPosition(positionId);
        });

        $('#choose_employee').on('change', function() {
            var choose_employee = $(this).val();
            var position_id = $('#position_id').val(); // Get the selected position_id
            getEmployeeTree(choose_employee, position_id);
        });

    });
</script>
