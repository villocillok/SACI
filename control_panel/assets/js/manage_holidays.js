$(document).ready(function() {
    $('#holidays-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [2] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-holiday-button"]').unbind('click');
            $('[data-button="delete-holiday-button"]').unbind('click');

            $('[data-button="edit-holiday-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_holidays_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Holiday', response);

                        $('[data-form="edit-holiday-form"]').submit(function() {
                            setDialogLoader();

                            $.ajax({
                                url: 'requests/manage_holidays.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=Edit',
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Edit Holiday Status', response['message']);

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

            $('[data-button="delete-holiday-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Holiday', '<div>Are you sure you want to delete this holiday?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');

                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_holidays.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Holiday Status', response['message']);

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

    $('[data-button="add-holiday-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_holidays_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Holiday', response);

                $('[data-form="add-holiday-form"]').submit(function() {
                    setDialogLoader();

                    $.ajax({
                        url: 'requests/manage_holidays.php',
                        method: 'POST',
                        data: $(this).serialize() + '&action=Add',
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Add Holiday Status', response['message']);

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