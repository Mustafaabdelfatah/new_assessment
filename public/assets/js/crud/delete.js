$(document).on('click', '.delete-button', function (event) {
    event.preventDefault();
    let id = $(this).data("id");
    let url = $(this).data("route");

    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        },
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            deleteCategory(url);
        }
    });

    function deleteCategory(url) {
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                $(`#row-${id}`).remove();

                toastr.options = {
                    // "positionClass": "toast-top-right",
                    // "timeOut": 3000,
                    // "toastClass": "toast"
                }
                toastr.success(response.message);
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.message;

                toastr.options = {
                    "positionClass": "toast-top-right",
                    "timeOut": 3000,
                    "toastClass": "toast toast-danger"
                }
                toastr.success(errors);

            }
        });
    }
});
