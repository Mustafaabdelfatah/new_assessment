var dataTable = $('#kt_datatable').DataTable({
    info: !1,
    dom: 'Bfrtip',
    buttons: [
        'csv', 'excel', 'pdf'
    ],
    retrieve: true,
    destroy: true,
    pageLength: 10,
    lengthChange: !1,
    order: [],
    columnDefs: [
        {
            orderable: !1, targets: 0
        },
        {
            orderable: !1, targets: 3
        }]
})

if(document.querySelector('[data-kt-datatable-filter="search"]')){
    document.querySelector('[data-kt-datatable-filter="search"]').addEventListener("keyup", (function (t) {
        dataTable.search(t.target.value).draw()
    }));
}

