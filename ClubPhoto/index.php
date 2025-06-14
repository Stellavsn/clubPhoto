<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Club Photo</title>
  <link rel="stylesheet" type="text/css" href="config/style.css?v=1.0" />
	<?php 
		include('config/connexion.php');
		$cnx=connexionPDO();		
	?>
</head>
<body>

<?php
	echo"<div id=titre>";
	include('bloc_entete.php');
	echo"</div>";
?>
 
<!-- Zone menu -->
<?php
	echo"<div id=menu>";
	include('bloc_menu.php');
	echo"</div>";
?>
 
<!-- Zone article -->
<?php
	echo"<div id=navigation>";
	if (isset($_GET['page'])) {
		include ($_GET['page'].".php");
	} else {
		include ("accueil.php");
	}		
	echo"</div>";
?>
 
<!-- Zone Pied de page -->
<?php
	echo"<div id=pied>";
	include('bloc_pied.php');
	echo"</div>";
?>

</body>
</html>