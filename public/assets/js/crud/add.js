

function firemodal(id) {

    $(id).modal('show');

}

$(document).ready(function () {
    $('#kt_modal_add_form').submit(function (event) {
        event.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let method = form.attr('method');
        let data = new FormData(form[0]); // use form[0] to get the DOM element
        $.ajax({
            url: url,
            type: method,
            data: data,
            processData: false, // prevent jQuery from processing the data
            contentType: false, // prevent jQuery from setting the content type
            success: function (response) {

                $('#kt_datatable_body').prepend(response);

                toastr.options = {
                    // "positionClass": "toast-top-right",
                    // "timeOut": 3000,
                    // "toastClass": "toast",
                    // "autoHide": false
                }
                toastr.success("Record created successfully.");
                $('#kt_modal_add').modal('hide');
                form[0].reset();
                $('.select_2').select2({});
                $('.nice-select').select2({});

            },
            error: function (xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                if (xhr.responseJSON.type == 'single') {

                    toastr.error(xhr.responseJSON.errors);
                    return 0;
                }

                $.each(errors, function (field, messages) {
                    let input = form.find('[name="' + field + '"]');

                    if (input.prop('multiple') && field.endsWith('[]')) {
                        // Handle select with multiple attribute and name ending in []
                        let group = input.closest('.fv-plugins-icon-container');
                        group.find('.help-block').remove();
                        group.addClass('has-error').append('<span class="help-block">' + messages + '</span>');
                        setTimeout(function () {
                            group.find('.help-block').fadeOut(500, function () {
                                $(this).remove();
                            });
                            group.removeClass('has-error');
                        }, 2000);
                    } else {
                        // Handle other inputs
                        input.each(function () {
                            let group = $(this).closest('.fv-plugins-icon-container');
                            group.find('.help-block').remove();
                            group.addClass('has-error').append('<span class="help-block">' + messages + '</span>');
                            setTimeout(function () {
                                group.find('.help-block').fadeOut(500, function () {
                                    $(this).remove();
                                });
                                group.removeClass('has-error');
                            }, 2000);
                        });
                    }
                });
            }
        });
    });
});
