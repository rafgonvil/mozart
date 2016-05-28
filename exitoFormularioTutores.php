<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionEntradasAlumnos.php");
if (isset($_SESSION['formularioTutor'])) {
	/*
	 * Se recogen los datos del formulario y se almacenan
	 * en otra variable
	 */
	$formulario = $_SESSION['formularioTutor'];
	unset($_SESSION['formularioTutor']);
	unset($_SESSION['erroresTutor']);
} else {
	Header("Location:formularioTutores.php");
}

$conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link type="text/css" rel="stylesheet" href="css/cssBase.css">
	<title>Éxito</title>
	<!-- <link type="text/css" rel="stylesheet" href="estilo/exito.css"> -->
</head>
<body>
	<?php
	include_once ("CabeceraGenerica.php");
	?>
	<div>
		<?php
		/*
		 * A partir de los datos del formulario se introduce un alumno
		 * en la tabla ALUMNO
		 */
		insertarTutor($formulario['nombreTutor'], $formulario['apellidosTutor'], $formulario['dniTutor'], $formulario['letraTutor'], $formulario['emailTutor'], $formulario['fnacTutor'], 
		$formulario['telefonoTutor'], $formulario['dniAlumnoTutor'], $formulario['letraAumnoTutor'], $conexion);
		
		?>
		<h1>Entrada registrada con éxito</h1>
		<a href="formularioTutores.php">Aquí</a> para volver al registro.
	</div>
	<?php
	include_once ("Pie.php");
	?>
</body>

<?php
cerrarConexionBD($conexion);
?>