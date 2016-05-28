<?php
session_start();
if (!isset($_SESSION['formularioTutor'])) {
	Header("Location:formularioTutores.php");
} else {
	$formulario['nombre'] = $_REQUEST['nombreTutor'];
	$formulario['apellidos'] = $_REQUEST['apellidosTutor'];
	$formulario['dni'] = $_REQUEST['dniTutor'];
	$formulario['letra'] = $_REQUEST['letraTutor'];
	$formulario['email'] = $_REQUEST['emailTutor'];
	$formulario['fnac'] = $_REQUEST['fnacTutor'];
	$formulario['telefono'] = $_REQUEST['telefonoTutor'];
	$formulario['dniAlumno'] = $_REQUEST['dniAlumnoTutor'];
	$formulario['letraAlumno'] = $_REQUEST['letraAlumnoTutor'];
	$_SESSION['formularioTutor'] = $formulario;
}

$errores = validar($formulario);
if (count($errores) > 0) {
	$_SESSION['erroresTutor'] = $errores;
	Header("Location:formularioTutores.php");
} else {
	Header("Location:exitoFormularioTutores.php");
}

function validar($formulario) {
	if (empty($formulario['nombre']))
		$errores[] = "El campo nombre no puede estar vacío";
	if (empty($formulario['apellidos']))
		$errores[] = "El campo apellidos no puede estar vacío";
	if (empty($formulario['dni']))
		$errores[] = "El campo DNI no puede estar vacío";
	if (empty($formulario['letra']))
		$errores[] = "El campo letra no puede estar vacío";
	if (empty($formulario['email']))
		$errores[] = "El campo correo electrónico no puede estar vacío";
	if (empty($formulario['fnac']))
		$errores[] = "El campo fecha de nacimiento no puede estar vacío";
	if (empty($formulario['telefono']))
		$errores[] = "El campo teléfono no puede estar vacío";
	if (empty($formulario['dniAlumno']))
		$errores[] = "El campo numero del DNi del alumno no puede estar vacío";
	if (empty($formulario['letraAlumno']))
		$errores[] = "El campo letra del DNI del alumno no puede estar vacío";
	return $errores;
}
?>