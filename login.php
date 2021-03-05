<?php
include_once 'database.php';
$result = mysqli_query($conn,"SELECT users.username, attendance.id, attendance.datesign, attendance.statut, attendance.motif  
	FROM attendance, student 
	WHERE attendance.iduser = student.id AND attendance.statut = 'abscent' AND attendance.motif = 'non justifiée'");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Student3</title>
</head>
<body>
<table>
<tr>
<td>Id</td>
<td> Name</td>
<td>Date</td>
<td>Statut</td>
<td>motif</td>
<td>Modifier</td>
</tr>


<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
if($i%2==0)
$classname="even";
else
$classname="odd";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["student_name"]; ?></td>
<td><?php echo $row["datesign"]; ?></td>
<td><?php echo $row["statut"]; ?></td>
<td><?php echo $row["motif"]; ?></td>

<td><a href="update-process.php?id=<?php echo $row["id"]; ?>">Update</a></td>
</tr>
<?php
$i++;
}
?>
</table>
</body>
</html>
