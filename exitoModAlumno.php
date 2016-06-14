<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionEntradasAlumnos.php");
if (isset($_SESSION['formMod'])) {
	$formularioMod = $_SESSION['formMod'];
	$formularioMod['oid'] = $_SESSION['alumno']['OID_P'];
	unset($_SESSION['formMod']);
	unset($_SESSION['errores']);
	unset($_SESSION['alumno']);
} else {
	Header("Location:alumnos.php");
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
	<div>
		<?php
		modificarAlumno($formularioMod['email'], $formularioMod['telefono'], $formularioMod['oid'], $conexion);
		?>
		<h1>Modificación registrada con éxito</h1>
		<a href="alumnos.php">Aquí</a> para volver al listado de alumnos.
	</div>
</body>
<?php cerrarConexionBD($conexion); ?>