<?php
session_start();
if (!isset($_SESSION['formularioAlumno'])) {
	Header("Location:formularioAlumnos.php");
} else {
	$formulario['nombre'] = $_REQUEST['nombreAlumno'];
	$formulario['apellidos'] = $_REQUEST['apellidosAlumno'];
	$formulario['dni'] = $_REQUEST['dniAlumno'];
	$formulario['letra'] = $_REQUEST['letraAlumno'];
	$formulario['email'] = $_REQUEST['emailAlumno'];
	$formulario['fnac'] = $_REQUEST['fnacAlumno'];
	$formulario['telefono'] = $_REQUEST['telefonoAlumno'];
	$formulario['curso'] = $_REQUEST['cursoAlumno'];
	$formulario['especialidad'] = $_REQUEST['especialidadAlumno'];
	$_SESSION['formularioAlumno'] = $formulario;
}

$errores = validar($formulario);
if (count($errores) > 0) {
	$_SESSION['erroresAlumno'] = $errores;
	Header("Location:formularioAlumnos.php");
} else {
	Header("Location:exitoFormularioAlumnos.php");
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
	if (empty($formulario['curso']))
		$errores[] = "El campo curso no puede estar vacío";
	if (empty($formulario['especialidad']))
		$errores[] = "El campo especialidad no puede estar vacío";
	return $errores;
}
?>