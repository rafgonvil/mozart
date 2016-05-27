<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionEntradasAlumnos.php");
if (isset($_SESSION['formulario'])) {
	/*
	 * Se recogen los datos del formulario y se almacenan
	 * en otra variable
	 */
	$formulario = $_SESSION['formulario'];
	unset($_SESSION['formulario']);
	unset($_SESSION['errores']);
} else {
	Header("Location:formularioAlumnos.php");
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
		insertarAlumno($formulario['nombre'], $formulario['apellidos'], $formulario['dni'], $formulario['letra'], $formulario['email'], $formulario['fnac'], $formulario['telefono'], $conexion);
		/*
		 * Una vez creado el alumno este es matriculado en el curso deseado
		 */
		insertarMatricula($formulario['curso'], $formulario['especialidad'], $formulario['dni'], $formulario['letra'], $conexion);
		?>
		<h1>Entrada registrada con éxito</h1>
		<a href="formularioAlumnos.php">Aquí</a> para volver al registro.
	</div>
	<?php
		include_once ("Pie.php");
	?>
</body>

<?php
cerrarConexionBD($conexion);
?>