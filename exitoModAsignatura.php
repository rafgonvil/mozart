<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionEntradasAsignaturas.php");
if (isset($_SESSION['formPunt'])) {
	$formularioPunt = $_SESSION['formPunt'];
	$formularioPunt['oid'] = $_SESSION['asignatura']['OID_A'];
	unset($_SESSION['formPunt']);
	unset($_SESSION['errores']);
	unset($_SESSION['asignatura']);
} else {
	Header("Location:asignaturas.php");
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
		modificarAsignatura($formularioPunt['ALUMNO'], $formularioPunt['oid'], $formularioPunt['PROFESOR'], $formularioPunt['NOTA'], $conexion);
		?>
		<h1>Modificación registrada con éxito</h1>
		<a href="asignaturas.php">Aquí</a> para volver al listado de alumnos.
	</div>
</body>
<?php cerrarConexionBD($conexion); ?>