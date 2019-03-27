$(document).ready(function() {
    $('#materials-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [5] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="edit-material-button"]').unbind('click');
            $('[data-button="delete-material-button"]').unbind('click');

            $('[data-button="edit-material-button"]').click(function() {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'forms/manage_materials_edit.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id')
                    },
                    success: function(response) {
                        setDialogHtmlContent('Edit Book', response);

                        $('#material-wizard').wizard2({
                            buttonLabels: {
                                prev: 'Prev',
                                next: 'Next',
                                finish: 'Edit',
                                help: '?'
                            },
                            onHelp: function(page, wiz) {
                                alert('Help function not yet available at the moment.');
                            },
                            onFinish: function(page, wiz) {
                                if(getDataSelect('eAuthors').length > 0) {
                                    var data = [getDataInput('eMaterialTitle'), 
									getDataInput('eYearPublished'), 
									getDataInput('eCollectionType'), 
									getDataInput('eIsbn'), 
									getDataInput('eEdition'), 
									getDataInput('eCallNumber'), 
									getDataInput('eDatePublishedMonth'), 
									getDataInput('eDatePublishedDay'), 
									getDataInput('eDatePublishedYear'), 
									getDataInput('ePublisher'), 
									getDataInput('eUnitOfPrice'), 
									getDataInput('eSection'), 
									getDataInput('eCategory'), 
									getDataSelect('eAuthors'), 
									getDataInput('eID'), 
									getDataInput('eQuantity')];
 
                                    setDialogLoader();
									//BUG 4b
									//previously it was id: data[9] --> refers to publisher
									//changed it to id: data[14] --> refers to bookID
                                    $.ajax({
                                        url: 'requests/manage_materials.php',
                                        method: 'POST',
                                        data: {
                                            action: 'Edit',
                                            id: data[14], 
                                            authors: data[13],
                                            publisher: data[9],
                                            section: data[11],
                                            bookTitle: data[0],
                                            callNumber: data[5],
                                            edition: data[4],
                                            yearPublished: data[8],
                                            unitOfPrice: data[10],                                            
                                            category: data[12],
											quantity: data[15]
                                        },
                                        success: function(response) {
                                            response = JSON.parse(response);
                                            setDialogContent('Edit Book Status', response['message']);

                                            setTimeout(function() {
                                                closeDialog();

                                                if(response['status'] == 'Success') {
                                                    location.reload();
                                                }
                                            }, 1500);
                                        }
                                    });

                                    return false;
                                } else {
                                    alert('Oops! Please select at least 1 author.');

                                    $('[data-input="eAuthors"]').focus();
                                }
                            }
                        });
                    }
                });

                return false;
            });

            $('[data-button="delete-material-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                setDialogHtmlContent('Delete Book', '<div>Are you sure you want to delete this book?</div><div class="align-right"><button class="button" data-button="no-button">No</button>&nbsp;&nbsp;<button class="button danger" data-button="yes-button">Yes</button></div>');
                
                $('[data-button="yes-button"]').click(function() {
                    $.ajax({
                        url: 'requests/manage_materials.php',
                        method: 'POST',
                        data: {
                            action: 'Delete',
                            id: id
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            setDialogContent('Delete Book Status', response['message']);

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

            $('[data-button="restore-material-button"]').click(function() {
                var id = $(this).data('var-id');

                setDialogLoader();
                openDialog();
                
                $.ajax({
                    url: 'requests/manage_materials.php',
                    method: 'POST',
                    data: {
                        action: 'Restore',
                        id: id
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        setDialogContent('Restore Book Status', response['message']);

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

    $('[data-button="add-material-button"]').click(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'forms/manage_materials_add.php',
            method: 'POST',
            success: function(response) {
                setDialogHtmlContent('Add Book', response);

                $('#material-wizard').wizard2({
                    buttonLabels: {
                        prev: 'Prev',
                        next: 'Next',
                        finish: 'Add',
                        help: '?'
                    },
                    onHelp: function(page, wiz) {
                        alert('Help function not yet available at the moment.');
                    },
                    onFinish: function(page, wiz) {
                        if(getDataSelect('aAuthors').length > 0) {
                            var data = [
                                getDataInput('aMaterialTitle'),         // 0
                                getDataInput('aCollectionType'),        // 1
                                getDataInput('aYearPublished'),         // 2
                                getDataInput('aIsbn'),                  // 3
                                getDataInput('aCallNumber'),            // 4
                                getDataInput('aDatePublishedMonth'),    // 5
                                getDataInput('aDatePublishedDay'),      // 6
                                getDataInput('aDatePublishedYear'),     // 7
                                getDataInput('aQuantity'),              // 8
                                getDataInput('aPublisher'),             // 9
                                getDataInput('aSection'),               // 10
                                getDataInput('aUnitOfPrice'),           // 11
                                getDataInput('aEdition'),               // 12
                                getDataInput('aCategory'),              // 13
                                getDataSelect('aAuthors')               // 14
                            ];

                            setDialogLoader();

                            $.ajax({
                                url: 'requests/manage_materials.php',
                                method: 'POST',
                                data: {
                                    action: 'Add',
                                    authors: data[14],
                                    publisher: data[9],
                                    section: data[10],
                                    bookTitle: data[0],
                                    callNumber: data[4],
                                    edition: data[12],
                                    yearPublished: data[7],
                                    quantity: data[8],
                                    unitOfPrice: data[11],
                                    category: data[13]
                                },
                                success: function(response) {
                                    response = JSON.parse(response);
                                    setDialogContent('Add Book Status', response['message']);

                                    setTimeout(function() {
                                        closeDialog();

                                        if(response['status'] == 'Success') {
                                            location.reload();
                                        }
                                    }, 1500);
                                }
                            });

                            return false;
                        } else {
                            alert('Oops! Please select at least 1 author.');

                            $('[data-input="eAuthors"]').focus();
                        }
                    }
                });
            }
        });

        return false;
    });
});