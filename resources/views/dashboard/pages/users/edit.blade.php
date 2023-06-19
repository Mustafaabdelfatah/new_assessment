<form id="edit-form"  class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route("admin.users.update",$user->id)}}" method="POST" data-method="PUT" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="id" id="row_id" value="{{$user->id}}">
    <div
        class="d-flex flex-column scroll-y me-n7 pe-7"
        data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}"
        data-kt-scroll-max-height="auto"
        data-kt-scroll-offset="300px"
        style="min-height: 300px;"
    >
        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-semibold fs-6 mb-2"> Name</label>
            <input type="text" id="name" value="{{$user->name}}" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="user Name"  />
         </div>

        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-bold fs-6 mb-2">Email</label>
            <input type="email" id="email" value="{{$user->email}}" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email"  />
        </div>

        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="fw-bold fs-6 mb-2">Phone</label>
            <input type="number" id="phone" value="{{$user->phone}}" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Phone"  />
        </div>

        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="fw-bold fs-6 mb-2">Image</label>
            <input type="file" id="image" name="image" class="form-control form-control-solid mb-3 mb-lg-0"/>
            <img id="image-preview" style="width: 60px; height: 60px;" src="{{$user?->image_path}}" alt="User Image" />
        </div>

        <div class="fv-row mb-7 fv-plugins-icon-container">
            <label class="required fw-bold fs-6 mb-2">Type</label>
            <select name="type" class="form-control nice-select">
                <option value="employee" {{$user->type == 'employee' ? 'selected' : ''}}>employee</option>
                <option value="admin" {{$user->type == 'admin' ? 'selected' : ''}}>admin</option>
            </select>
        </div>


        <div class="fv-row mb-7">
            <label class=" required fw-bold fs-6 mb-2">Position</label>
            <select name="position_id" id="position" class="form-control nice-select" >
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{$user->position_id ==  $position->id ? 'selected' : ''}}>{{ $position->title }}</option>
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
     $(document).ready(function () {
        $("#image").change(function () {
            console.log("Image selected");
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });

    });
</script>
