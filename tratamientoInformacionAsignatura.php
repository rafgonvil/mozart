<?php
session_start();
if (!isset($_SESSION['formPunt'])) {
	Header("Location:asignaturas.php");
} else {
	$formPunt['NOTA'] = $_REQUEST['input_nota'];
	$_SESSION['formPunt'] = $formPunt;
}

$errores = validarMod($formPunt);

if (count($errores) > 0) {
	$_SESSION['errores'] = $errores;
	Header("Location:informacionAsignatura.php");
} else {
	Header("Location:exitoModAsignatura.php");
}

function validarMod($formulario) {
	if (empty($formulario['NOTA'])) {
		$errores[] = "El campo nota no puede estar vacío";
	}
	return $errores;
}
?>