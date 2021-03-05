<?php
$conn=mysqli_conn("localhost","root","", "taken");
mysqli_select_db($conn,"users");
	
	$email=$_POST['email'];
	$password=$_POST['password'];
	$check=mysqli_query($conn,"select * from users where email='$email' and password='$password'");
	var_dump($_SESSION)
	if (mysqli_num_rows($check)>0)
	{
		$_SESSION['email']=$email;
		$_SESSION['password']=$password;
		echo json_encode(array('result==1'));

	}
	else{
		// echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
	
?>