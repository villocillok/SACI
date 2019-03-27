function show_adv_s(){

	var disp = document.getElementById("s_normal").style.display;
	if(disp == "block"){
		document.getElementById("s_normal").style.display = "none";
		document.getElementById("s_advance").style.display = "block";
	}
	else if (disp == "none"){
		document.getElementById("s_normal").style.display = "block";
		document.getElementById("s_advance").style.display = "none";
	}

}

function author_box(){


	var disp = document.getElementById("auth_sel").style.display;
	if(disp == "block"){
		document.getElementById("auth_sel").style.display = "none";
		document.getElementById("new_author_info").style.display = "block";
	}
	else if (disp == "none"){
		document.getElementById("auth_sel").style.display = "block";
		document.getElementById("new_author_info").style.display = "none";
	}
}

$(document).ready(function (){
	
	$('[data-submit="normal-search"]').click(function(){
		
		$.ajax({
			url : 'search/normal_search.php',
			method : 'POST',
			data : {
				title : $('[data-input="normal-search"]').val()
			},
			success : function (response){
				setHtmlTable(response, $('[data-receiver="some-table"]'));
			}
		})
	});
	
	$('[data-toggle="advanced-search"]').change(function (){
		if($(this).is(":checked")){
			$("#s_advance").css({
				"display" : "block"
			});
			$("#s_normal").css({
				"display" : "none"
			});
		}
		else {
			$("#s_advance").css({
				"display" : "none"
			});
			$("#s_normal").css({
				"display" : "block"
			});
		}
	});
	
	$('[data-submit="submit-button"]').click(function (){
		var data_input = $('#s_advance :input');
		$.ajax({
			url: 'search/advanced_search.php',
			method: 'POST',
			data: {
				title: data_input[0].value,
				author: data_input[1].value,
				date_published: data_input[2].value
			},
			success: function (response){
				setHtmlTable(response, $('[data-receiver="some-table"]'));
			}
		});
	});
	
});

$('[data-report="search-report"]').click(function (){
		
			alert("Hello");
	});

function setHtmlTable(val, data_receiver){
	$(data_receiver).html(val);
}