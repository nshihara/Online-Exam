	$(function() {
		
		$("#regsubmit").click(function() {
		  var name = $("#name").val();
		  var username = $("#username").val();
		  var password = $("#password").val();
		  var email = $("#email").val();
		  
		  var user = {
			name: name,
			username: username,
			password: password,
			email: email
		  };
		  
		  $.ajax({
			type: "POST",
			url: "http://example.com/api/register",
			data: JSON.stringify(user),
			contentType: "application/json",
			success: function(data) {
			  $("#state").html(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
			  console.log(jqXHR.responseText);
			}
		  });
	  
		  return false;
		});
	  });

//User Login
	$("#loginsubmit").click(function(){
		var email       = $("#email").val();
		var password = $("#password").val();
		var dataString = 'email='+ email + '&password=' + password;
		$.ajax({
			type: "post",
			url: "getlogin.php",
			data: dataString,
			success: function(data){
				if($.trim(data) == "empty"){
					$(".empty").show();
					setTimeout(function(){
						$(".empty").fadeOut();
					},4000);
				}else if($.trim(data) == "disable"){
					$(".disable").show();
					setTimeout(function(){
						$(".disable").fadeOut();
					},4000);
				}else if($.trim(data) == "error"){
					$(".error").show();
					setTimeout(function(){
						$(".error").fadeOut();
					},4000);
				}else{
					window.location = "exam.php";
				}
			}
		});
		return false;
	});
	