<?php
include 'database.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>page de signature</title>
</head>
<body>
<h1>vous avez signé votre presence avec succès </h1>


<SCRIPT LANGUAGE="JavaScript">
var maintenant=new Date();
document.write(maintenant);
</SCRIPT>
<br>


<br>
<br>
<div>
<button type="button" class="btn btn-primary btn-lg"><a href="index.php">Deconnection</a></button>
</div>
</body>
</html>