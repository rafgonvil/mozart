<?php
session_start();

if (!isset($_SESSION['asignatura'])) {
	Header("Location:alumnos.php");
}

$asignatura['OID_A'] = $_REQUEST['OID_A'];
$asignatura['NOMBRE'] = $_REQUEST['NOMBRE'];
$asignatura['ESPECIALIDAD'] = $_REQUEST['ESPECIALIDAD'];
$asignatura['PROFESOR'] = $_REQUEST['PROFESOR'];

$_SESSION['asignatura'] = $asignatura;

if (isset($_REQUEST['punt']))
	Header("Location:informacionAsignatura.php");
?>