$(document).ready(function() {
    var list = [];

    $('#materials-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [4] },
            { bSearchable: false, bSortable: false, aTargets: [5] }
        ],
        fnDrawCallback: function(oSettings) {
            var index;

            $('[data-input="loan-checkbox"]').unbind('change');

            $('[data-input="loan-checkbox"]').change(function() {
                if(this.checked) {
                    list.push($(this).data('var-id'));

                    console.log('Checked: ' + $(this).data('var-id'));
                } else {
                    index = list.indexOf($(this).data('var-id'));

                    if(index > -1) {
                        list.splice(index, 1);
                    }

                    console.log('Unchecked: ' + $(this).data('var-id'));
                }

                console.log(list);
            });
        }
    });

    $('[data-button="borrow-button"]').click(function() {
        var borrower = $('[data-input="borrower"]').val();

        if(borrower != null) {
            if(list.length > 0) {
                setDialogLoader();
                openDialog();

                $.ajax({
                    url: 'requests/loan_materials.php',
                    method: 'POST',
                    data: {
                        borrower: borrower,
                        book: list
                    },
                    success: function(response) {
						console.log(response);
                        response = JSON.parse(response);
                        setDialogHtmlContent('Loan Status', response['message']);

                        $('[data-button="print-button"]').click(function() {
                            //TODO: Print Receipt
                            closeDialog();
                            $('#dialog').html('<iframe style="display: none;" src="requests/receipt.php?data='+response['data']+'" onload="this.contentWindow.print();"></iframe>');

                            //location.reload();
                        });
                    }
                });

                return false;
            } else {
                alert('Oops! Please select at least 1 material to borrow.');
            }
        } else {
            alert('Oops! Please select a borrower.');
        }
    });
});