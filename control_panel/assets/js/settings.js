$(document).ready(function() {
    $('[data-form="penalty-settings-form"]').submit(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'requests/manage_settings.php',
            method: 'POST',
            data: $(this).serialize() + '&action=penalty',
            success: function(response) {
                response = JSON.parse(response);

                setDialogContent('Penalty Settings Status', response['message']);
                
                setTimeout(function() {
                    closeDialog();

                    window.location = './settings.php';
                }, 1500);
            }
        });

        return false;
    });

    $('[data-form="student-settings-form"]').submit(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'requests/manage_settings.php',
            method: 'POST',
            data: $(this).serialize() + '&action=student',
            success: function(response) {
                response = JSON.parse(response);
                
                setDialogContent('Borrower Settings Status', response['message']);

                setTimeout(function() {
                    closeDialog();

                    window.location = './settings.php';
                }, 1500);
            }
        });

        return false;
    });

    $('[data-form="faculty-settings-form"]').submit(function() {
        setDialogLoader();
        openDialog();

        $.ajax({
            url: 'requests/manage_settings.php',
            method: 'POST',
            data: $(this).serialize() + '&action=faculty',
            success: function(response) {
                response = JSON.parse(response);
                
                setDialogContent('Librarian Settings Status', response['message']);

                setTimeout(function() {
                    closeDialog();

                    window.location = './settings.php';
                }, 1500);
            }
        });

        return false;
    });
});