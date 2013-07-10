$(function() {  
  $(".button").click(function() 
  {  
  		var id = $("input#dogId").val();

		var dataString = 'dogId='+ id;  

		alert (dataString);  
		$.ajax({  
		  type: "POST",  
		  url: "index.php?route=main&action=search",  
		  data: dataString,  
		  success: function(response) 
		  {  
		  	alert(response);
		  }  
		});  
		return false; 
  });  
});  