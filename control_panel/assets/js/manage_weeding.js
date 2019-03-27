$(document).ready(function() {
    $('#weeding-table').dataTable({
        aoColumnDefs: [
            { bSearchable: false, bSortable: false, aTargets: [4] }
        ],
        fnDrawCallback: function(oSettings) {
			$("[data-button='restore-material-button']").click(function(){
				
				setDialogLoader();
                openDialog();
				
				$.ajax({
					
					url: 'requests/manage_weeding.php',
					method: 'POST',
					data: {id: $(this).data('var-id')},
					success: function (response){
						response = JSON.parse(response);
						setDialogHtmlContent('Book Weeding Status', response['message']);
						
						setTimeout(function() {
							closeDialog();

							if(response['status'] == 'Success') {
								location.reload();
							}
						}, 1500);
					}
				});
			})
        }
    });
});