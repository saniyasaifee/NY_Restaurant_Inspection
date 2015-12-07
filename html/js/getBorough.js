

$(function(){
		$.post('getBorough.php',function(data){
			$("#borough").html(data);		
		});	
	});
