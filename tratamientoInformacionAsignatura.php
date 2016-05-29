<?php
session_start();
if (!isset($_SESSION['formPunt'])) {
	Header("Location:asignaturas.php");
} else {
	$formPunt['NOTA'] = $_SESSION['formPunt']['NOTA'];
	$_SESSION['formPunt'] = $formPunt;
}

$errores = validarMod($formPunt);

if (count($errores) > 0) {
	$_SESSION['errores'] = $errores;
	Header("Location:informacionAsignatura.php");
} else {
	Header("Location:exitoModAlumno.php");
}

function validarMod($formulario) {
	if (empty($formulario['NOTA'])) {
		$errores[] = "El campo nota no puede estar vacío";
	}
	return $errores;
}
?>