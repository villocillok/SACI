$(document).ready(function() {
	var list = []
    $('#materials-table').dataTable();

    $('[data-input="borrower"]').change(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'requests/load_borrowed_materials.php',
            method: 'POST',
            data: {
                id: $(this).val()
            },
            success: function(response) {
                closeDialog();
                
                $('#materials-table').dataTable().fnDestroy();
                $('#materials-table > tbody').html(response);
                $('#materials-table').dataTable({
                    aoColumnDefs: [
                        { bSearchable: false, bSortable: false, aTargets: [6] }
                    ],
                    fnDrawCallback: function(oSettings) {
                        $('[data-button="return-material-button"]').unbind('click');

                        $('[data-button="return-material-button"]').click(function() {
                            var id = $(this).data('var-id');

                            setDialogLoader();
                            openDialog();
                            setDialogHtmlContent('Return Material', '<div>Returning this material will also settle its penalty.<br>Have you already received the payment for the penalty?</div><div class="align-right"><button class="button" data-button="no-button">Not Yet</button>&nbsp;&nbsp;<button class="button success" data-button="yes-button">Yes</button></div>');
                            
                            $('[data-button="yes-button"]').click(function() {
                                setDialogLoader();
                                openDialog();

                                $.ajax({
                                    url: 'requests/receive_materials.php',
                                    method: 'POST',
                                    data: {
                                        id: id
                                    },
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        setDialogContent('Return Status', response['message']);

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
            }
        });

        return false;
    });
});