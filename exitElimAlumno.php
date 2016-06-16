<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionEntradasAlumnos.php");
if (isset($_SESSION['formMod'])) {
	$formularioMod = $_SESSION['formMod'];
	$formularioMod['oid'] = $_SESSION['alumno']['OID_P'];
	unset($_SESSION['formModTutor']);
	unset($_SESSION['errores']);
	unset($_SESSION['tutor']);
} else {
	Header("Location:alumno.php");
}

$conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Éxito</title>
	<link type="text/css" rel="stylesheet" href="css/cssBase.css">
</head>
<body>
	<?php
	include_once ("CabeceraGenerica.php");
	?>
	<div>
		<?php
		eliminarAlumno($conexion, $formularioMod['oid']);
		?>
		<h1>Entrada eliminada con éxito</h1>
		<a href="alumnos.php">Aquí</a> para volver al registro.
	</div>
	<?php
	include_once ("Pie.php");
	?>
</body>
<?php cerrarConexionBD($conexion); ?>