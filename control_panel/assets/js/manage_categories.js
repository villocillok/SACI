$(document).ready(function() {
    $('#categories-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [2] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-category-button"]').unbind('click');
            $('[data-button="delete-category-button"]').unbind('click');

            $('[data-button="edit-category-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_categories_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Category', response);

                        $('[data-form="edit-category-form"]').submit(function() {
                            setDialogLoader();

                            $.ajax({
                                url: 'requests/manage_categories.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=Edit',
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Edit Category Status', response['message']);

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

            $('[data-button="delete-category-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Category', '<div>Are you sure you want to delete this category?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');

                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_categories.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Category Status', response['message']);

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

    $('[data-button="add-category-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_categories_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Category', response);

                $('[data-form="add-category-form"]').submit(function() {
                    setDialogLoader();

                    $.ajax({
                        url: 'requests/manage_categories.php',
                        method: 'POST',
                        data: $(this).serialize() + '&action=Add',
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Add Category Status', response['message']);

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