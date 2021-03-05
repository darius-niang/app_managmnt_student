<!DOCTYPE html>
<html>
<head>
	<title>students3</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	 <!-- Font Icon -->
	 <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

<!-- Main css -->
<link rel="stylesheet" href="css1/style.css">
</head>
<body class="container bg-info">	
	<div class="main col-sm-3">
		<div class="sign-in">
			<div class="container content-center">
				<div class="signin-content">
					<div class="signin-image">
                        <a href="register.php" class="signup-image-link"></a>
					</div>
					<div class="signin-form">
                        <h2 class="form-title">Veuillez Signer</h2>
						<form id="login_form" name="form1" method="post">	
							<div class="form-group col-sm-7">
								<label for="pwd"><i class="zmdi zmdi">Email</i></label>
								<input type="email" class="form-control" id="email_log" placeholder="Email" name="email" onkeyup="checkemail();">
							</div>
							<div class="form-group col-sm-7">
								<label for="pwd"><i class="zmdi zmdi"></i>Password</label>
								<input type="password" class="form-control" id="password_log" placeholder="Password" name="password" onkeyup="checkpass();">
							</div><br><br><br><br><br><br><br><br>
							<input type="submit" name="submit" class="form-submit" value="Signer" id="butlogin">
							<a href="index.php" class="form-submit">Retour</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


<script>
$(document).ready(function() {
	
	$('#butlogin').on('click', function(e) {
		e.preventDefault();
		var email = $('#email_log').val();
		var password = $('#password_log').val();
		if(email!="" && password!="" ){
			$.ajax({
				url: "checkMichel.php",
				type: "POST",
				data: {
					type:2,
					email: email,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "connect.php";		
					}
					else if(dataResult.statusCode==201){
						 
						alert(dataResult.statusMessage);
					}
					
				}
			});
		}
		else{
			alert('Remplissez tous les champs !');
		}
	});
});
</script>
</body>
</html>    
     