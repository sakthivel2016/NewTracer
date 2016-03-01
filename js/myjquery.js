$(function () {
// Dialog Open	 
$("#d1").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Add": function() { 
	  	
		var id = $("#id").val(),
		name = $('#name').val(),
		age = $('#password').val();
		if(id=='' || name=='' || age=='')
			{
				//alert("Please do not empty....!",title="Hello");
				$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#id:first").focus();	
							}
						}
					}); 
				exit;
			}//End if statement
			
		$.post('user/process.php',{
			user_role: id, user_name: name, user_password: age, action:'joined'
		});//End Post
		$("#id").val('');
		$("#name").val('');
		$("#password").val('');				
		$(this).dialog("close");		
		},
      "Cancel": function() { 
	  	$("#id").val('');
		$("#name").val('');
		$("#password").val('');
	  	$(this).dialog("close"); 
		} 
    }
});


$("#d2").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Ok": function() { $(this).dialog("close"); } 
    }
});

$("#b1").click(function(){
    $("#d1").dialog("open");
});
});