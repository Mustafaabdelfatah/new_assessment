<div class="modal fade" id="assign-question-modal" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_assign_question">
                <h2 class="fw-bold">Assign Question</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-categories-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->

            <form  id="assign-question-form" class="form fv-plugins-bootstrap5 fv-plugins-framework"  method="POST"  action="">
                @csrf
                <input type="hidden" name="assessment_id" id="assessment_id" value="">

                <div
                    class="d-flex flex-column scroll-y me-n7 pe-7"
                    id="kt_modal_add_user_scroll"
                    data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}"
                    data-kt-scroll-max-height="auto"
                    data-kt-scroll-offset="300px"
                    style="max-height: 168px;"
                >
                <!--begin::Scroll-->
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select class="form-control nice-select" name="category_id" id="category_id" >
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 fv-plugins-icon-container">
                        <select name="question_id[]" id="question_id" class="form-control nice-select" multiple>
                        </select>
                        <span id="question-error" class="text-danger"></span>


                    </div>
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
