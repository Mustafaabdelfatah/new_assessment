<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bold">Add User</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-categories-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->

            <form id="kt_modal_add_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"  method="POST" action="{{route("admin.users.store")}}"
                enctype="multipart/form-data">
                @csrf
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

                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container" >
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="name"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name"
                            />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="email" name="email"
                            class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="example@domain.com" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Phone</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" name="phone"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Phone ..." />
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <div class="fv-row mb-7 fv-plugins-icon-container" >
                        <!--begin::Label-->
                        <label class=" fw-semibold fs-6 mb-2">Select Image</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="file" accept="image/*" name="image" id="image-input"
                            class="form-control form-control-solid mb-3 mb-lg-0" />
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Type</label>
                        <select name="type" class="form-control nice-select ">
                            <option value="employee">employee</option>
                            <option value="admin">admin</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7 fv-plugins-icon-container" >
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Position</label>
                        <select class="form-control nice-select" name="position_id" id="position_id" >
                            <option value="">Select Position</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->title }}</option>
                            @endforeach
                        </select>
                        @error('position_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--end::Input-->
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
