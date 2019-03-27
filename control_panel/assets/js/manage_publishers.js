$(document).ready(function() {
    $('#publishers-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [2] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-publisher-button"]').unbind('click');
            $('[data-button="delete-publisher-button"]').unbind('click');

            $('[data-button="edit-publisher-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_publishers_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Publisher', response);

                        $('[data-form="edit-publisher-form"]').submit(function() {
                            setDialogLoader();

                            $.ajax({
                                url: 'requests/manage_publishers.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=Edit',
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Edit Publisher Status', response['message']);

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

            $('[data-button="delete-publisher-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Publisher', '<div>Are you sure you want to delete this publisher?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');

                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_publishers.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Publisher Status', response['message']);

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

    $('[data-button="add-publisher-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_publishers_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Publisher', response);

                $('[data-form="add-publisher-form"]').submit(function() {
                    setDialogLoader();

                    $.ajax({
                        url: 'requests/manage_publishers.php',
                        method: 'POST',
                        data: $(this).serialize() + '&action=Add',
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Add Publisher Status', response['message']);

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