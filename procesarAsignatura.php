<?php
    session_start();

    if (!isset($_SESSION['asignatura'])) {
        Header("Location:asignaturas.php");
    }
    
    $asignatura['OID_A'] = $_REQUEST['OID_A'];
    $asignatura['NOMBRE'] = $_REQUEST['NOMBRE'];
    $asignatura['PROFESOR'] = $_REQUEST['PROFESOR'];
    $asignatura['MATRICULA'] = $_REQUEST['MATRICULA'];
    $asignatura['ESPECIALIDAD'] = $_REQUEST['ESPECIALIDAD'];

    $_SESSION['asignatura'] = $asignatura;

    if (isset($_REQUEST['info']))
        Header("Location:informacionAsignatura.php");
?>