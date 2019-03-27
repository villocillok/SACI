$(document).ready(function() {
    $('#department-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [2] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-department-button"]').unbind('click');
            $('[data-button="delete-department-button"]').unbind('click');

            $('[data-button="edit-department-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_department_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Department', response);

                        $('[data-form="edit-department-form"]').submit(function() {
                            setDialogLoader();

                            $.ajax({
                                url: 'requests/manage_department.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=Edit',
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Edit Department Status', response['message']);

                                    setTimeout(function() {
                                        closeDialog();

                                        if(response['status'] == 'Success') {
                                            location.reload();
                                        }
                                    }, 1500);
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });

            $('[data-button="delete-department-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Department', '<div>Are you sure you want to delete this department?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');

                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_department.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Department Status', response['message']);

                            setTimeout(function() {
                                closeDialog();

                                if(response['status'] == 'Success') {
                                    location.reload();
                                }
                            }, 1500);
                        }
                    });

                    return false;
                });

                $('[data-button="no-button"]').click(function() {
                    closeDialog();
                });
            });
        }
    });

    $('[data-button="add-department-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_department_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Department', response);

                $('[data-form="add-department-form"]').submit(function() {
                    setDialogLoader();

                    $.ajax({
                        url: 'requests/manage_department.php',
                        method: 'POST',
                        data: $(this).serialize() + '&action=Add',
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Add Department Status', response['message']);

                            setTimeout(function() {
                                closeDialog();

                                if(response['status'] == 'Success') {
                                    location.reload();
                                }
                            }, 1500);
                        }
                    });

                    return false;
                });
            }
        });

        return false;
    });
});