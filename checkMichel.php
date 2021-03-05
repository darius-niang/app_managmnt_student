<?php
    session_start();
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'taken';
    
    $conn = mysqli_connect($host, $user, $pass, $db);
	
	if($_POST['type']==2){

		$email=$_POST['email'];
		$password=$_POST['password'];
		 
		$check=mysqli_query($conn,"SELECT * FROM users  WHERE email='$email' AND password = '$password' ");
		// var_dump($check);
		if (mysqli_num_rows($check)>0)
		{
			$student = mysqli_fetch_assoc($check);
			$idStudent = $student['id'];
			$date=date("Y-m-d");
			$checkStudent = mysqli_query($conn, "SELECT * FROM attendance WHERE iduser='$idStudent' AND datesign='$date'");
			// var_dump(mysqli_num_rows($checkStudent)>0);
			// var_dump($date);
			// var_dump($idStudent);
			if (mysqli_num_rows($checkStudent)>0) {
				echo json_encode(array("statusCode"=>201, "statusMessage"=>'vous avez deja signer'));
			}else {
				$time = date("H-m-s");
				$nameStudent = $student['username'];
				$sql = "INSERT INTO attendance (iduser, student_name, datesign, times) VALUES ('$idStudent','$nameStudent', '$date','$time')";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo json_encode(array("statusCode"=>200, "statusMessage"=>'Merci d\'avoir signer'));
				}
			}
			//$_SESSION["email"]=$email;			           
		}
		else{
			echo json_encode(array("statusCode"=>201, "statusMessage"=>'l\'un de vos acces est incorrect'));
		}
		mysqli_close($conn);
	}
?>
  