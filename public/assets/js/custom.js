$(document).ready(function () {

    $('.select_2').select2({});
    $('.nice-select').select2({
        minimumResultsForSearch: -1

    });

});

// for assessment add & edit
function getAssessManagerByPosition(positionId) {
    if (positionId) {
        $.ajax({
            url: '/get-assessManager-by-position/' + positionId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#manager_id').empty();
                $('#manager_id').append('<option value="">Select Manager</option>');
                $.each(data, function (key, value) {
                    $('#manager_id').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    } else {
        $('#manager_id').empty();
    }
}


function getEmployeeTree(choose_employee, position_id) {
    if (choose_employee) {
        $.ajax({
            url: '/get-employee-tree/', type: 'GET', data: {
                "choose_employee": choose_employee, "position_id": position_id,
            }, dataType: 'json', success: function (data) {
                $('#employee_ids').empty();
                $('#employee_ids').append('<option value="all">Select All</option>');
                $.each(data, function (key, value) {
                    $('#employee_ids').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    } else {
        $('#employee_ids').empty();
    }
}

