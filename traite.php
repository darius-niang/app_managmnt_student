<?php
session_start();
include 'database.php';

// recuperation de id

$user_id = $_SESSION["id"];
    
echo 'Vous etre connecté avec l\'id '.$user_id.'';

$sql = mysqli_query($conn, "select username, phone, email, password, file_name from users where id='$user_id' ");

$row = mysqli_fetch_assoc($sql);
$name = $row["username"];
$phone = $row["phone"];
$email = $row["email"];
$pass = $row["password"];
$file_name = $row["file_name"];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Student profil</title>
    <meta charset="utf-8">
    <!-- CSS only -->
    

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
// traiter les erreur avec php
$error_name = '';
$error_phone = '';
$error_email = '';
$error_image = '';
$error_pass = '';
$error = 0;
$success = '';

if (isset($_POST["button_action"])) {
    $name_new = $_POST["name"];
    $email_new = $_POST["email"];
    $phone_new = $_POST["tel"];
    $pass1_new = $_POST["password"];
    $pass2_new = $_POST["password1"];
    $Newpass = $pass;

    if ($pass != $pass1_new || $name_new == '') {
        if ($name_new == '') {
            $error_name = 'le champ nom doit pas etre vide';
        }
        if ($pass != $pass1_new) {
            $error_pass = 'mot de passe saisi est incorrect';
        }
    } else {
        if ($pass2_new != '') {
            $Newpass = $pass2_new;
        }

        if ($_FILES['file']['name']) {
            $FName = md5($_FILES['file']['name']);
            echo $_FILES['file']['name'];
            echo "je suis present";
            $NewFile = "uploads/" . $FName;
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $NewFile)) {
                die("Failed to move file " . $_FILES['file']['tmp_name'] . " to " . $FName);
            } else {
                $update = mysqli_query($conn, "UPDATE users SET name = '$name_new', tel = '$phone_new', email= '$email_new', password = '$Newpass' , file_name = '$NewFile' WHERE id='$user_id'");
            }
        } //si fichier n'existe pas
        else {
            $update = mysqli_query($conn, "UPDATE users SET name = '$name_new', tel = '$phone_new', email= '$email_new', password = '$Newpass' WHERE id='$user_id'");
        }
        $update = mysqli_query($conn, "UPDATE users SET name = '$name_new', tel= '$phone_new', email= '$email_new', password = '$Newpass' WHERE id='$user_id'");

        if ($update) {
            
            $_SESSION["id"]=$user_id;
            $_SESSION['email']=$email_new;
            $_SESSION['password']=$Newpass;
            $status = 'success';
            $success = '<div class="alert alert-success">Profile Details Change Successfully</div>';
           
            
            header('Location: profilEtudiant.php');
        } else {
            echo  'Echec modification, Veuillez reprendre.';
        }


        mysqli_close($conn);
    }
}




?>

<body class="container bg-success">

    <div class="container" style="margin-top:30px">
        <span><?php echo $success; ?></span>
        <div class="card">
        
            <form method="post" name="profile_form" id="profile_form" enctype="multipart/form-data">
            <div>
            <input type="text" name="editeId" value="<?php echo$user_id?>">
            </div><br>
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9 btn btn-success">Mon Profil</div><br><br>
                        <div class="col-md-3" align="right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo$name ?>" />
                                <span class="text-danger"><?php echo$error_name ?> </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Telephone <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="tel" id="tel" class="form-control" value="<?php echo$phone ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control" value=" <?php echo$email ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Ancien password <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo$pass ?>" />
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
                            <label class="col-md-4 text-right">Confirmez Nouveau password <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="" onchange="checkpass();" />
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Photo <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="file" name="file" />
                                <span class="text-muted">seul fichier .jpg et .png</span><br />
                                <img src="<?php echo$file_name?>" class="img-thumbnail" style="width:200px;height:210px;">
                            </div>         
                        </div>
                    </div>
                </div>
                <div class="card-footer" align="center">


                    <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Sauvegarder" />
                </div>
            </form>
        </div>
    </div>
    <br />
    <a href="profilEtudiant.php" class="btn btn-warning btn-lg form-submit">Retour</a>
</body>

</html>


