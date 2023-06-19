<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bold">Add Assessment</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-categories-modal-action="close">
                </div>
            </div>

            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->

            <form id="kt_modal_add_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"  method="POST" action="{{route("admin.assessments.store")}}"
                enctype="multipart/form-data">
                @csrf
                <div
                    class="d-flex flex-column scroll-y me-n7 pe-7"
                    id="kt_modal_add_user_scroll"
                    data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}"
                    data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px"
                    style="min-height: 468px;"
                >
                <!--begin::Scroll-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container" >
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2"> Title</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="title"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title"
                            />
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::select group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container" >
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Type</label>
                        <!--end::Label-->
                        <!--begin::select-->
                        <select name="type" class="form-control nice-select" id="type">
                            <option value="monthly"> Monthly</option>
                            <option value="three_month">Three Month</option>
                            <option value="six_month">Six Month</option>
                            <option value="1_year">1 Year</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::select-->
                    </div>
                    <!--end::select group-->

                    <!--begin::select group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Start Date</label>
                        <!--end::Label-->
                        <!--begin::select-->
                        <select name="start_date" class="form-control nice-select" id="">
                        @php
                            $year = date('Y');
                            $month = 1;
                            $end_month = 12;
                        @endphp
                        @for ($i = $month; $i <= $end_month; $i++)
                             <option value="{{ $i }}-{{ $year }}">{{ $i }}-{{ $year }}</option>
                        @endfor
                        </select>
                        @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::select-->
                    </div>
                    <!--end::select group-->
                    <!--begin::select group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Select Position</label>
                        <!--end::Label-->
                        <!--begin::select-->
                        <select name="position_id" class="form-control nice-select" id="position_id">
                            <option value="">Select Position</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->title }} </option>
                             @endforeach
                        </select>
                        @error('position_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::select-->
                    </div>
                    <!--end::select group-->

                    <!--begin::select group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Select Manager</label>
                        <!--end::Label-->
                        <!--begin::select-->
                        <select name="manager_id" class="form-control nice-select" id="manager_id">
                        </select>
                        @error('manager_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::select-->
                    </div>
                    <!--end::select group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container assess_employee" >
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Employee</label>
                        <!--end::Label-->
                        <!--begin::select-->
                        <select name="employee_ids[]" class="form-control select_2" id="employee_ids" multiple>
                            @foreach ($users as $user )
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('employee_ids[]')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::select-->
                    </div>
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Discard
                    </button>

                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).ready(function() {


        $('#position_id').on('change', function() {
            var positionId = $(this).val();
            getAssessManagerByPosition(positionId);
        });

    });
</script>
