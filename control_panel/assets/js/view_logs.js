$(document).ready(function() {
    $('#logs-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [2] }
        ]
    });
});