<form id="edit-form"  class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route("admin.questions.update",$question->id)}}" method="POST" data-method="PUT" >
    @csrf
    <input type="hidden" name="id" id="row_id" value="{{$question->id}}">
    <input type="hidden" name="old_percentage"  value="{{$question->percentage}}">

    <div
        class="d-flex flex-column scroll-y me-n7 pe-7"
        data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}"
        data-kt-scroll-max-height="auto"
        data-kt-scroll-offset="300px"
        style="max-height: 168px;"
    >
        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-semibold fs-6 mb-2"> Title</label>
            <input type="text" id="title" value="{{$question->title}}" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Question Title"  />
         </div>

          <select name="percentage"  class="form-select form-select-lg nice-select mb-3" aria-label=".form-select-lg example">
            @for ($percentage = 10; $percentage <= 100; $percentage += 10)
                <option value="{{ $percentage }}" {{ $question->percentage == $percentage ? 'selected' : '' }}>
                    {{ $percentage }}%
                </option>
            @endfor
        </select>
          <br>
          <div class="fv-row mb-7">
            <label class="fw-bold fs-6 mb-2">Categories</label>
            <select name="categories[]" id="categories" class="form-control nice-select" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{in_array($category->id, $question->categories->pluck('id')->toArray()) ? 'selected' : ''}} >{{ $category->name }}</option>
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


<script>
$(document).ready(function() {
    $('.nice-select').select2({
        minimumResultsForSearch: -1
    });
});
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script src="{{ asset('assets/select2.min.js')}}"></script>



