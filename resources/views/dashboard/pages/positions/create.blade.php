<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_position_header">
                <h2 class="fw-bold">Add Position</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-positions-modal-action="close">
                    {{-- <i class="ki-outline ki-cross fs-1"></i> --}}
                </div>
            </div>

            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                      method="POST" action="{{route("admin.positions.store")}}">
                    @csrf
                    <div
                        class="d-flex flex-column scroll-y me-n7 pe-7"
                        id="kt_modal_add_position_scroll"
                        data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-offset="300px"
                        style="min-height: 168px;"
                    >

                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <label class="required fw-semibold fs-6 mb-2"> Title</label>
                            <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Position Title"/>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Parent</label>
                            <select id="parent_id" name="parent_id" class="form-control nice-select ">
                                <option value="">select parent position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-positions-modal-action="cancel">
                            Discard
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-positions-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress"> Please wait... <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span> </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
