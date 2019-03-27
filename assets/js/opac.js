$(document).ready(function() {
    $('#materials-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [3] },
            { bSearchable: false, bSortable: false, aTargets: [4] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="reserve-button"]').unbind('click');
            
            $('[data-button="reserve-button"]').click(function() {
                setDialogLoader();
                openDialog();

                console.log("data-button: reserve-button");

                $.ajax({
                    url: 'requests/reservation_request.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id'),
                        action: $(this).data('var-action')
                    },
                    success: function(response) {
						console.log(response);
                        response = JSON.parse(response);

                        setDialogContent('Reservation Status', response['message']);

                        setTimeout(function() {
                            closeDialog();

                            window.location = "./";
                        }, 1500);
                    }
                });

                return false;
            });
        }
    });

    $('#reservations-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [3] }
        ],
        fnDrawCallback: function(oSettings) {
            $('[data-button="delete-reserve-button"]').click(function() {
                setDialogLoader();
                openDialog();

                console.log("data-button: delete-reserve-button");

                $.ajax({
                    url: 'requests/reservation_request.php',
                    method: 'POST',
                    data: {
                        id: $(this).data('var-id'),
                        action: $(this).data('var-action')
                    },
                    success: function(response) {
                        response = JSON.parse(response);

                        setDialogContent('Reservation Status', response['message']);

                        setTimeout(function() {
                            window.location = "./reservations.php";
                        }, 1500);
                    }
                });

                return false;
            });
        }   
    });

    $('[data-form="login-form"]').submit(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'requests/login_request.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                var loginResponse;
                var elementClass;

                closeDialog();

                if(response['status'] == 'Success') {
                    $('#login-response').html('<br><div class="bg-green fg-white padding10">' + response['message'] + '</div>');

					console.log(response['redirect']);
                    window.location = response['redirect'];
                } else {
                    $('#login-response').html('<br><div class="bg-red fg-white padding10">' + response['message'] + '</div>');
                }
            },
            error: function(arg1, arg2, arg3) {
                console.log(arg1.responseText);
            }
        });

        return false;
    });
});