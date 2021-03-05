
 <?php

include 'database.php';
session_start();

    $email = $_SESSION["email"];
     $dup = mysqli_query($conn,"select * from users where email = '$email' ");
     $row = mysqli_fetch_assoc($dup);
      $id = $row["id"];
      $_SESSION['id'] = $row["id"];
      $_SESSION['username'] = $row["username"];
      $_SESSION['email'] = $row["email"];
      $_SESSION['password'] = $row["password"];
      $_SESSION['phone'] = $row["phone"];
      $_SESSION['sex'] = $row["sex"];
      $_SESSION['file_name'] = $row["file_name"];


      // Le graphe
    // utiliser pour envoyer des donnees dans la base de donne

$req = "select  case when mois=1 then CONCAT('Janavier-',ANNEE)
              when mois=2 then CONCAT('Fevrier-',ANNEE)
			  when mois=3 then CONCAT('Mars-',ANNEE)
			  when mois=4 then CONCAT('Avril-',ANNEE)
			  when mois=5 then CONCAT('Mai-',ANNEE)
			  when mois=6 then CONCAT('Juin-',ANNEE)
			  when mois=7 then CONCAT('Juillet-',ANNEE)
			  when mois=8 then CONCAT('Aout-',ANNEE)
			  when mois=9 then CONCAT('Septembre-',ANNEE)
			  when mois=10 then CONCAT('Octobre-',ANNEE)
			  when mois=11 then CONCAT('Novembre-',ANNEE)
			  when mois=12 then CONCAT('Decembre-',ANNEE) end MOIS_NOM,
			  nonbre from(
 SELECT YEAR (datesign) ANNEE,MONTH (datesign)  mois ,COUNT(id) nonbre 
FROM `attendance` WHERE iduser = '$_SESSION[id]' AND statut = 'present' GROUP BY  MONTH (datesign),YEAR (datesign)
 ) as t"; 


 if($result=$conn->query($req)){
$dataPoints = array();
$graph = array();
while($row=$result->fetch_row()){
  array_push($graph,array("y" => $row[1], "label" => "$row[0]"));

}
 }


$dataPoints = $graph;


?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>


<!-- javascript traitant le graphe -->
<script> 
window.onload = function () { 
 
var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: "Classe Student "
  },
  axisX: { 
    title: "Mois"
  },

   axisY: {
    title: "nombre de signature"
  },
  
  data: [{
    type: "spline",
    markerSize: 2,
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
})
chart.render();
 
}
</script>
</head>
<body class="container bg-light">
<br>

   
   
<div class="row bg-info text-light">
  <div class="col-3 p-2"><h2><?php echo $_SESSION["name"]; ?></h2></div>
  <div class="col p-2"></div>
  <div class="col-1 p-1 d-flex flex-reverse "><button type="button" class="btn btn-warning"><a href="logout.php" class="text-light">Lougout</a></button></div>
  <div class="col-2 p-2 d-flex flex-reverse text-light"></div>
  <!-- //bouton pour modifier le profil -->

    <form method="post" action="login.php"  >
        <input type="hidden"  value="<?php echo $row["id"];?>"/>
        <button type="submit" class="btn btn-warning btn-lg" ><a href="traite.php" class="text-light">Modifier</a></button><br/>
    </form>
</div>
   
    <span>
		<a href="index.php" class="text-info">Accueil</a>
    </span><br>

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">

                    <img src="<?php echo $_SESSION["file_name"]?>" alt=""/><br><br>
                    <p></p>
                    
                        <div class="file">
						<div class="col-md-2">
							<input type="submit" class="profile-edit-btn btn-warning" name="btnAddMore" value="Editer votre Profile"/><br/><br/><br/>
						</div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label> Id </label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION["id"];?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION["name"];?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION["email"];?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>téléphone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION["telephone"]; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>sexe</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION["sexe"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>        
    </form>  
</div>
<br><br>

<div class="col-10" id="chartContainer" style="height: 370px; width: 100%;"></div>

<br><br>
<br><br>

    <style>
	.table-content{border-top:#CCCCCC 4px solid; width:50%;}
	.table-content th {padding:5px 20px; background: #F0F0F0;vertical-align:top;} 
	.table-content td {padding:5px 20px; border-bottom: #F0F0F0 1px solid;vertical-align:top;} 
	</style>
	</head>
	
	<body>

 <!-- signature -->
<?php
 $id = $_SESSION['id'];
      $sql = "SELECT `iduser`, `datesign`, `statut`, `motif` FROM `attendance` WHERE `statut`= 'abscent' AND `iduser`= '$id'";
	$result = mysqli_query($conn,$sql);
   
?>

    <div class="demo-content">
		<h2 class="title_with_link">Student 3</h2>
    </div>
 
<?php if(!empty($result))	 { ?>
<table class="table-content">
    <thead>
        <tr>          
          <th width="30%"><span>Datesign</span></th>
          <th width="30%"><span>statut</span></th> 
          <th width="40%"><span>Motif</span></th>         	  
        </tr>
    </thead>
    <tbody>
	<?php
		while($row = mysqli_fetch_array($result)) {
	?>
        <tr>
                
            <td><?php echo $row["datesign"]; ?></td>
            <td><?php echo $row["statut"]; ?></td>
            <td><?php echo $row["motif"]; ?></td>

        </tr>
    <?php
		}
    ?>
    </tbody> 
</table>
<?php } ?>

 <!-- fin signature -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>



