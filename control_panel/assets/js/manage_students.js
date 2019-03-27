$(document).ready(function() {
    $('#students-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [4] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-student-button"]').unbind('click');
            $('[data-button="delete-student-button"]').unbind('click');

            $('[data-button="edit-student-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_students_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Borrower', response);

                        $('[data-form="edit-student-form"]').submit(function() {
                            setDialogLoader();
							console.log($(this).serialize());
                            $.ajax({
                                url: 'requests/manage_students.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=Edit',
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Edit Borrower Status', response['message']);

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

            $('[data-button="delete-student-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Borrower', '<div>Are you sure you want to delete this borrower?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');
                
                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_students.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Borrower Status', response['message']);

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

    $('[data-button="add-student-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_students_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Borrower', response);

                $('[data-form="add-student-form"]').submit(function() {
                    setDialogLoader();

                    $.ajax({
                        url: 'requests/manage_students.php',
                        method: 'POST',
                        data: $(this).serialize() + '&action=Add',
                        success: function(response) {
                            console.log(response);
                            response = JSON.parse(response);
                            setDialogContent('Add Borrower Status', response['message']);

                            setTimeout(function() {
                                closeDialog();

                                if(response['status'] == 'Success') {
                                    location.reload();
                                }
                            }, 1500);
                        },
                        error: function(arg1, arg2, arg3) {
                            console.log(arg1.responseText);
                        }
                    });

                    return false;
                });
            }
        });

        return false;
    });
});