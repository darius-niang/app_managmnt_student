<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>connexion professeur</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="login-page form-row col-6" align="center"><br><br>
		<div class="form">
			<h1>Page connexion Prof</h1>
		 
			<div id="message"></div>
		 
			<form class="login-form" id="regform" action="" method="POST">
			  <input type="text" placeholder="Email" name="email" id="email"/>
			  <span id="uemail"></span>
			  <input type="password" placeholder="password" name="password" id="password"/>
			  <span id="upass" name="upass"></span><br><br>
			  <input type="submit" class="btn" name="submit" id="submt" value="connexion">
			  <a href="index.php" class="form-submit">Retour</a>
			</form>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
  $("#regform").on("submit",function(e){

   
    $('#upass').html('');
    $('#uemail').html('');

    $('#message').html('');
        
    
        var password=$("#password").val();
        var email = $('#email').val();

        if($("#email").val()==""){//on verifie si le champ email est vide
              $("#uemail").html("Please enter email.");
               $("#uemail").css("color", "red");
               $("#email").css("border", "1px solid grey");
              $("#email").focus();
        }
        else if($("#password").val()==""){//on verifie si le champ password est vide
              $("#upass").html("Please enter password.");
               $("#upass").css("color", "red");
               $("#password").css("border", "1px solid grey");
              $("#password").focus();
        }
      else
      {
           $.ajax({//ajax envoie les informations a la page check.php pour verifier si les password et email sont identiques
            type:"POST",
            url:"tabl.php",
            data:{"password":password,"email":email},
            success:function(result){
             if(result==1){
                 location.href="darsh.php";
                }
                else{//si c'est pas identiques, message erreur et valider si identique
                $("#message").html("mauvais identifiant");
                $("#message").css("color", "green");
           }
          }

    });

}

e.preventDefault();


  });

</script>
</body>
</html>