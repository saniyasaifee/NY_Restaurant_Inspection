

$(function(){
		$.post('getGrading.php',function(data){
			$("#grade").html(data);		
		});	
	});
