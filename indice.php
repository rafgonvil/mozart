<?php
session_start();
unset($_SESSION[""]);
unset($_SESSION[""]);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Proyecto Mozart</title>
		<link type="text/css" rel="stylesheet" href="css/cssBase.css">
	</head>
	<body>
	<?php include_once("CabeceraGenerica.php");?>
<div id="contenidoPag">
	<?php 
		if(isset($_SESSION['erroresIndex'])){
		 	$erroresIndex = $_SESSION['erroresIndex'];
			echo "<div id='muestraErrores'>";
			foreach($erroresIndex as $error){
				print("<div class='error'>");
				print("$error");
				print("</div>");
			}echo "</div>";	}
	?>	
</div>
<?php 	include_once("Pie.php"); ?>
</body>
</html>