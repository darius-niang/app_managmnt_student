<?php
session_start();
include 'database.php';


$id = $_SESSION["id"];
$email = $_SESSION["email"];

// $pass = $_SESSION["password"];



?>
<!DOCTYPE html>
<html>

<head>
    <title>Attendance profil</title>
    <meta charset="utf-8">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag -------- -->
    <SCRIPT language="Javascript">
        function checkpass() {
            if (document.profile_form.password1.value != document.profile_form.password2.value) {
                window.alert("mots de passe non conforme");
            }
            //     else {
            //     //    function bien(){ok}
        }
    </SCRIPT>
</head>

<?php


$error_email = '';

$error_pass = '';
$error = 0;
$success = '';

if (isset($_POST["button_action"])) {
    
    // $email_new = $_POST["email"];
    $pass_old = $_POST["password"];
    $pass_new = $_POST["password1"];
    // $Newpass = $pass;
    $checkdata=" SELECT password FROM prof WHERE id='$id' AND password = '$pass_old'  ";
    $query=mysqli_query($conn, $checkdata);
    $row = mysqli_num_rows($query);
    if($row>0)
    {
     $update = mysqli_query($conn, "UPDATE prof SET password = '$pass_new' WHERE id='$id'");

        if ($update) {

            $_SESSION["id"]=$id;
            // $_SESSION['email']=$email_new;
            $_SESSION['password']=$pass_new;
            $success = 'success';
            header('Location: darsh.php');
        }
    }
    else
    {
        echo "ancien mot pass non correcte";
    }
}
   




?>

<body class="container bg-info">
    <br>
    <a href="darsh.php">Accueil</a>
    <div class="container" style="margin-top:30px">
        <span><?php echo $success; ?></span>
        <div class="card">
            <form method="post" name="profile_form" id="profile_form" enctype="multipart/form-data">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">Changer Votre Password</div>
                        <div class="col-md-3" align="right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <!--     <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control" value="<?php echo$email ?>" />
                                <span class="text-danger"> <?php echo $error_email ?></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Ancien password <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" value="<?php ?>" />
                                <span class="text-danger"> <?php echo $error_pass ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Nouveau password <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="password" name="password1" id="password1" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Confirmer password <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="" onchange="checkpass();" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" align="center">

                    <input type="submit" name="button_action" id="button_action" class="btn btn-info btn-sm" value="Valider" />
                </div>
            </form>
        </div>
    </div>
    <br />
    <br />
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css" />
</body>

</html>


