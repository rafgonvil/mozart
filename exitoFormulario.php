<?php
    session_start();
    //include_once("gestionbd.php");
    if (isset($_SESSION['formulario'])) {
        $formulario = $_SESSION['formulario'];
        unset($_SESSION['formulario']);
        unset($_SESSION['errores']);
    } else {
        Header("Location:formularioAlumnos.php");
    }
    
    //$conexion = crearConexionBD();
?>


<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Éxito</title>
    <!-- <link type="text/css" rel="stylesheet" href="estilo/exito.css"> -->
</head>
<body>
    <div>
        <!-- Codigo php para insertar una entrada  -->
        <h1>Entrada registrada con éxito</h1>
        <a href="formularioAlumnos.php">Aquí</a> para volver al registro.
    </div>
</body>

<?php
    //cerrarConexionBD($conexion);
?>