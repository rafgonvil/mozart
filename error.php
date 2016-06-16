<?php
    session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta content="Content-Type" content="text/html; charset=UTF-8" />
		<title>Error</title>
	</head>
	<body>
		<h1>Se ha producido un error</h1>
		<?php
			echo $_SESSION['excepcion'];
            unset($_SESSION['excepcion']);
		?>
		<p>Contacte con el administrador de la base de datos.</p>
		<p><a href="indice.php">Aquí</a> para regresar al registro.</p>
	</body>
</html>