<?php
session_start();
require_once ("gestionBD.php");
require_once ("gestionEntradasAlumnos.php");

$conexion = crearConexionBD();

if (!isset($_SESSION['alumno'])) {
	Header("Location:alumnos.php");
}

$alumno['OID_P'] = $_REQUEST['OID_P'];
$alumno['NOMBRE'] = $_REQUEST['NOMBRE'];
$alumno['DNI'] = $_REQUEST['DNI'];
$alumno['EMAIL'] = $_REQUEST['EMAIL'];
$alumno['FECHA_NACIMIENTO'] = $_REQUEST['FECHA_NACIMIENTO'];
$alumno['TELEFONO'] = $_REQUEST['TELEFONO'];
$alumno['CURSO'] = $_REQUEST['CURSO'];
$alumno['ESPECIALIDAD'] = $_REQUEST['ESPECIALIDAD'];

$_SESSION['alumno'] = $alumno;

if (isset($_REQUEST['info']))
	Header("Location:informacionAlumno.php");

if (isset($_REQUEST['asig']))
	Header("Location:informacionAsignaturas.php");
?>