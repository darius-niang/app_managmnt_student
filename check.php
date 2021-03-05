<?php
session_start();
	include 'database.php';
	// var_dump($_POST);
	if($_POST['type']==1){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$sex=$_POST['sex'];
	$password=$_POST['password'];
	

	$sql = "INSERT INTO `users`( `username`, `email`, `phone`, `sex`, `password`) 
	VALUES ('$name','$email','$phone`','$sex','$password')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
}

	if($_POST['type']==2){
		$email=$_POST['email'];
		$password=$_POST['password'];
		$check=mysqli_query($conn,"select * from users where email='$email' and password='$password'");
		// $query=$conn->query($sql);
		// var_dump($check);
		if (mysqli_num_rows($check)>0)
		{
			
			while($row =mysqli_fetch_object($check)) {
				$_SESSION['id']=$row->id;
	  		$_SESSION['name']=$row->username;
	  		$_SESSION['email']=$row->email;
			  $_SESSION['password']=$row->password;
			  $_SESSION['telephone']=$row->phone;
			  $_SESSION['sexe']=$row->sex;
			  $_SESSION['file_name']=$row->file_name;
				}
				  $answer='ok';
			echo json_encode(array("statusCode"=>200));
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
	}

	if($_POST['type']==3){
		$email=$_POST['email'];
		$password=$_POST['password'];
		$check=mysqli_query($conn,"select * from prof where email='$email' and password='$password'");
		if (mysqli_num_rows($check)>0)
		{
			$_SESSION['email']=$email;
			echo json_encode(array("statusCode"=>200));
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
	}
?>
 