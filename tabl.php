<?php
$conn=mysqli_connect("localhost","root","", "taken");
mysqli_select_db($conn,"prof");

$uemail=$_REQUEST["email"];
$register_sql=mysqli_query($conn,"select * from  prof where email='".$uemail."'");
$numrows=mysqli_num_rows($register_sql);
if($numrows>0){
	echo 0;
}
else
{
		$email=$_POST["email"];
		$password=md5($_POST["password"]);
		
		$insertq=mysqli_query($conn,"insert into prof set email='".$email."',password='".$password."',status=1 ");
   echo 1;
}				
	
?>