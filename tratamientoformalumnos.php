<?php
    session_start();
    if (!isset($_SESSION['formulario'])) {
        Header("Location:formularioAlumnos.php");
    } else {
        $formulario['nombre'] = $_REQUEST['nombre'];
        $formulario['apellidos'] = $_REQUEST['apellidos'];
        $formulario['dni'] = $_REQUEST['dni'];
        $formulario['letra'] = $_REQUEST['letra'];
        $formulario['email'] = $_REQUEST['email'];
        $formulario['fnac'] = $_REQUEST['fnac'];
        $formulario['telefono'] = $_REQUEST['telefono'];
        $formulario['curso'] = $_REQUEST['curso'];
        $formulario['especialidad'] = $_REQUEST['especialidad'];
        $_SESSION['formulario'] = $formulario;
    }
    
    $errores = validar($formulario);
    if(count($errores) > 0) {
        $_SESSION['errores'] = $errores;
        Header("Location:formularioAlumnos.php");
    } else {
        Header("Location:exitoFormulario.php");
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