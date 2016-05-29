<?php
    session_start();
    
    if (!isset($_SESSION['tutor'])) {
        Header("Location:tutores.php");
    }
    
    $tutor['OID_P'] = $_REQUEST['OID_P'];
    $tutor['NOMBRE'] = $_REQUEST['NOMBRE'];
    $tutor['DNI'] = $_REQUEST['DNI'];
    $tutor['EMAIL'] = $_REQUEST['EMAIL'];
    $tutor['FECHA_NACIMIENTO'] = $_REQUEST['FECHA_NACIMIENTO'];
    $tutor['TELEFONO'] = $_REQUEST['TELEFONO'];
    $tutor['ALUMNO'] = $_REQUEST['ALUMNO'];
    
    $_SESSION['tutor'] = $tutor;
    
    if (isset($_REQUEST['info']))
        Header("Location:informacionTutor.php");
?>