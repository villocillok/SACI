$(document).ready(function() {
    $('#section-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [2] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-section-button"]').unbind('click');
            $('[data-button="delete-section-button"]').unbind('click');

            $('[data-button="edit-section-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_section_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Section', response);

                        $('[data-form="edit-section-form"]').submit(function() {
                            setDialogLoader();

                            $.ajax({
                                url: 'requests/manage_section.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=Edit',
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Edit Section Status', response['message']);

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

            $('[data-button="delete-section-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Section', '<div>Are you sure you want to delete this section?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');

                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_section.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Section Status', response['message']);

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

    $('[data-button="add-section-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_section_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Section', response);

                $('[data-form="add-section-form"]').submit(function() {
                    setDialogLoader();

                    $.ajax({
                        url: 'requests/manage_section.php',
                        method: 'POST',
                        data: $(this).serialize() + '&action=Add',
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Add Section Status', response['message']);

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