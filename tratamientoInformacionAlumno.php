<?php
    session_start();
    if (!isset($_SESSION['formMod'])) {
        Header("Location:alumnos.php");
    } else {
        $formMod['email'] = $_REQUEST['input_email'];
        $formMod['telefono'] = $_REQUEST['input_telefono'];
        $_SESSION['formMod'] = $formMod;
    }
    
    $errores = validarMod($formMod);
    
    if (count($errores) > 0) {
        $_SESSION['errores'] = $errores;
        Header("Location:informacionAlumno.php");
    } else {
        Header("Location:exitoModAlumno.php");
    }
    
    function validarMod($formulario) {
        if (empty($formulario['email'])) {
            $errores[] = "El campo email no puede estar vacío";
        } else if (empty($formulario['telefono'])) {
            $errores[] = "El campo telefono no puede estar vacío";
        } else if (strlen($formulario['telefono']) < 9) {
            $errores[] = "El campo teléfono no está debidamente cumplimentado";
        }
        return $errores;
    }
?>