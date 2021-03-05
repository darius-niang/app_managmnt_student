<!DOCTYPE html>
<html>
    <head>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Student Attendance3</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">


    </head>
    <body class="container bg-light">
        <div class="container col-sm-5">
            <table class="table table-striped bg-info">
				<tbody>
                    <div class="signup-content">
                    <div id="result">  
                    </div>
				     <tr>
                      <div class="signup-form">
                        <td colspan="1">
                            <form class="well form " method="POST" enctype="multipart/form-data" id="register-form" onsubmit="return checkall();">
                                <fieldset>
                                    <div class="form-group">
									  <h1 style="text-align: center; ">Formulaire D'Inscription</h1>
                                        <label for="">Name</label>
                                        <input class="form-control" type="text" name="username" id="UserName" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Email</label>
                                        <input class="form-control" type="text" name="useremail" id="UserEmail" placeholder="Email" required onkeyup="checkemail();">
                                        <span id="email_status"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Phone</label>
                                        <input class="form-control" type="tel" name="userphone" id="UserPhone" placeholder="+225 08 00 00 35" required onkeyup="checkphone();">
                                        <span id="phone_status"></span>
                                    </div>
									<div class="form-group ">
                                        <label for=""> Password</label>
                                        <input class="form-control" type="password" name="userpass" id="UserPassword" placeholder="Password (8 Max)" required maxlength="8">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Password</label>
                                        <input class="form-control" type="password" name="userpass2" id="UserPassword2" placeholder="Confirmer (8 Max)" required maxlength="8" onkeyup="checkpass();">
                                        <span id="pass_status"></span>
                                    </div>
                                    <div class="form-group col-sm-10">
										<label class="col-md-4 control-label">Photo</label>
                                        <input class="form-control" type="file" name="file" id="image"/>
                                    </div>
                                    <div class="form-group pull-right col-sm-2">
									  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-user"></i></span>
                                        <input class="form-control" type="radio" name="sex" id="homme" class="agree-term" value="male"checked />
                                        <label for="agree-term" class="label-agree-term">Homme</label> 
                                        <input class="form-control" type="radio" name="sex" id="agree-term" class="agree-term" value="femelle" />
                                        <label for="agree-term" class="label-agree-term">Femme</label>
                                    </div>
									<div id="tweet" align="center">
                                    <div class="form-group form-button col-sm-4">
                                        <input class="form-control btn btn-secondary" id="myForm" type="submit" name="submit_form" class="form-submit" value="Enregistrer"/><br><br>
                                        <a href="index.php" class="form-control btn btn-secondary">Acceuil</a>
                                    </div>
                                </fieldset>
                            </form>
						</td>
                      </div>
					 </tr>
                    </div>
                </tbody>
            </table>
        </div>

    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
        function checkphone()//Fonction qui vérifie si le téléphone existe ou pas
        {
            var phone=document.getElementById( "UserPhone" ).value;
                
            if(phone)
            {
                $.ajax({
                    type: 'post',
                    url: 'checkdata.php',
                    data: {
                    user_phone:phone,
                    },
                    success: function (response) {
                        $( '#phone_status' ).html(response);
                        if(response=="OK")	
                        {
                            return true;	
                        }
                        else
                        {
                            return false;	
                        }
                    }
                });
            }
                else
                {
                    $( '#phone_status' ).html("");
                    return false;
                }
        }

        function checkemail()//Fonction qui vérifie si le mail existe ou pas
        {
        var email=document.getElementById( "UserEmail" ).value;
            
        if(email)
        {
            $.ajax({
                type: 'post',
                url: 'checkdata.php',
                data: {
                user_email:email,
                },
                success: function (response) {
                    $( '#email_status' ).html(response);
                    if(response=="OK")	
                    {
                        return true;	
                    }
                    else
                    {
                        return false;	
                    }
                }
            });
            }
            else
            {
                $( '#email_status' ).html("");
                return false;
            }
        }

        function checkpass()//Fonction qui vérifie si les mMdp correspondent
        {
            var pass2=document.getElementById( "UserPassword2" ).value;
            var pass=document.getElementById( "UserPassword" ).value;
                
            if(pass2)
            {
                $.ajax({
                    type: 'post',
                    url: 'checkdata.php',
                    data: {
                    user_pass2:pass2,
                    user_pass:pass,
                    },
                    success: function (response) {
                        $( '#pass_status' ).html(response);
                        if(response=="OK")	
                        {
                            return true;	
                        }
                        else
                        {
                            return false;	
                        }
                    }
                });
            }
                else
                {
                    $( '#pass_status' ).html("");
                    return false;
                }
        }

$(document).ready(function() {
	
    $("#register-form").on("submit", function(e){
		e.preventDefault();
		    var namehtml=$('#phone_status').html();
            var emailhtml=$('#email_status').html();
            var passhtml=$('#pass_status').html();
            if((namehtml == "OK") && (emailhtml == "OK") && (passhtml == "OK"))
            {
                var form = $(this);// (this) fait reference a ["#register-form"]    
                var formdata = new FormData(form[0]);
                formdata.append("file", $('#image')); 
                $.ajax({
                    method: "POST",
                    enctype: 'multipart/form-data',// type d'encodage 
                    url: "checkdataMichel.php",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "JSON",
                    // envoi des donné hmtl sous forme JSON au lieu de html afin de simplifier les choses,
                    // 
                    data: formdata,
				success: function(insertResult){
					//var insertResult = JSON.parse(data);
					if(insertResult.msg == 'success'){
                        $("#register-form").trigger('reset');
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Inscription reussie, veillez inscrire un nouveau etudiant ou vous connecter <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
					else{
						 
                    alert(insertResult.msg);
                        $('#result').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> '+insertResult.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
					
				}
			});
            }
            else
            {
                $('#result').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">verifier si les champs Email, Contact et Mot de Passe sont bien rempli<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                return false;//On ne peut pas s'incrire
            }
	});
});
    function checkall()
        {
            var namehtml=document.getElementById("phone_status").innerHTML;
            var emailhtml=document.getElementById("email_status").innerHTML;
            var passhtml=document.getElementById("pass_status").innerHTML;

            if((namehtml && emailhtml && passhtml)=="OK")
            {
                return true;//On peut s'inscrire
            }
            else
            {
                return false;//On ne peut pas s'incrire
            }
        }


    </script>
    </body>
</html>
