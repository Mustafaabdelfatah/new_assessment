<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-image-form" action="{{ route('admin.update-image') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
                <div class="modal-header">
                    <h5 class="modal-title" id="image-modal-label">Update Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" name="image" id="image" accept="image/*" />
                </div>
                <img id="image-preview" style="width: 60px; height: 60px; margin-left: 20px;" src="{{ asset('storage/users/' . auth()->user()->image) }}" alt="Profile Image" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
<script>
    document.getElementById("profile-image").addEventListener("click", function () {
        $("#image-modal").modal("show");
    });
    $(document).ready(function () {
        $("#image").change(function () {
            console.log("Image selected");
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
        $("#update-image-form").submit(function (event) {
            event.preventDefault();
            console.log("asd");
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#profile-image").attr("src", data.image);
                    $("#image-modal").modal("hide");
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });
        });
    });
</script>
@endpush
