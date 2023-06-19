<form id="edit-form"  class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route("admin.categories.update",$category->id)}}" method="POST" data-method="PUT" >
        @csrf
        <input type="hidden" name="id" id="row_id" value="{{$category->id}}">
        <div
            class="d-flex flex-column scroll-y me-n7 pe-7"
            data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}"
            data-kt-scroll-max-height="auto"
            data-kt-scroll-offset="300px"
            style="max-height: 168px;"
        >
            <div class="fv-row mb-7 fv-plugins-icon-container">
                <label class="required fw-semibold fs-6 mb-2"> Name</label>
                <input type="text" id="name" value="{{$category->name}}" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Category Name"  />
             </div>

            <div class="fv-row mb-7">
                <label class="fw-bold fs-6 mb-2">Status</label>
                <select class="form-control nice-select" id="status" name="status">
                    @foreach(\App\Enums\CategoryStatus::getValues() as $value)
                        <option value="{{ $value }}" {{$category->status == $value ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
                    @endforeach
                </select>
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

