

function firemodal(id) {
    $(id).modal('show');
}



$(document).on('click', '.edit-record', function () {
    const id = $(this).data('id');
    const route = $(this).data('route');
    $.ajax({
        type: 'GET',
        url: route,
        success: function (response) {
            $('.edit-body').html(response);
            $('.nice-select').select2({});
            $('#edit-modal').modal('show');
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
$(document).ready(function () {
    $(document).on('click', '#edit-form-submit', function (e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var url = form.attr('action');
        let recordId = $('#row_id').val();
        let formData = new FormData(form[0]);
        formData.append('recordId', recordId);

        formData.append('_method', 'PUT');
        formData.append('image', $('#image').val());

        $.ajax({
            type: 'POST', 
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
                $(`#kt_datatable_body #row-${recordId}`).html(response)
                toastr.options = {
                    // "positionClass": "toast-top-right",
                    // "timeOut": 3000,
                    // "toastClass": "toast"
                }
                toastr.success("Record Updated successfully.");
                $('#edit-modal').modal('hide');
                form[0].reset();
                $('.nice-select').select2({});
            },
            error: function (xhr, status, error) {
                console.log(xhr.status === 422, xhr.responseJSON);
                let errors = xhr.responseJSON.errors;
                if (xhr.responseJSON.type == 'single') {

                    toastr.error(xhr.responseJSON.errors);
                    return 0;
                }
                $.each(errors, function (field, messages) {
                    form.find('[name="' + field + '"]').each(function () {
                        let input = $(this);
                        let group = input.closest('.fv-plugins-icon-container');

                        group.find('.help-block').remove();

                        group.addClass('has-error').append('<span class="help-block">' + messages + '</span>');

                        setTimeout(function () {
                            group.find('.help-block').fadeOut(500,
                                function () {
                                    $(this).remove();
                                });
                            group.removeClass('has-error');
                        }, 2000);
                    });
                });
            }
        });
    });
});


// $(document).ready(function () {
//     $(document).on('click', '#edit-form-submit', function (e) {
//         e.preventDefault();

//         var form = $(this).closest('form');
//         var url = form.attr('action');
//         let recordId = $('#row_id').val();
//         let data = form.serialize();
//         $.ajax({
//             type: 'PUT',
//             url: url,
//             data: data,
//             success: function (response) {
//                 // console.log(response);
//                 $(`#kt_datatable_body #row-${recordId}`).html(response)
//                 toastr.options = {
//                     // "positionClass": "toast-top-right",
//                     // "timeOut": 3000,
//                     // "toastClass": "toast"
//                 }
//                 toastr.success("Record Updated successfully.");
//                 $('#edit-modal').modal('hide');
//                 form[0].reset();
//                 $('.nice-select').select2({});
//             },
//             error: function (xhr, status, error) {
//                 console.log(xhr.status === 422, xhr.responseJSON);
//                 let errors = xhr.responseJSON.errors;
//                 if (xhr.responseJSON.type == 'single') {

//                     toastr.error(xhr.responseJSON.errors);
//                     return 0;
//                 }
//                 $.each(errors, function (field, messages) {
//                     form.find('[name="' + field + '"]').each(function () {
//                         let input = $(this);
//                         let group = input.closest('.fv-plugins-icon-container');

//                         group.find('.help-block').remove();

//                         group.addClass('has-error').append('<span class="help-block">' + messages + '</span>');

//                         setTimeout(function () {
//                             group.find('.help-block').fadeOut(500,
//                                 function () {
//                                     $(this).remove();
//                                 });
//                             group.removeClass('has-error');
//                         }, 2000);
//                     });
//                 });
//             }
//         });
//     });
// });
