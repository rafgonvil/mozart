<?php
    session_start();
    include_once("gestionBD.php");
    include_once("gestionEntradasTutores.php");
    if (isset($_SESSION['formMod'])) {
        $formularioMod = $_SESSION['formMod'];
        $formularioMod['oid'] = $_SESSION['tutor']['OID_P'];
        unset($_SESSION['formModTutor']);
        unset($_SESSION['errores']);
        unset($_SESSION['tutor']);
    } else {
        Header("Location:tutores.php");
    }
    
    $conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Éxito</title>
    <link type="text/css" rel="stylesheet" href="css/cssBase.css">
</head>
<body>
    <div>
        <?php
            modificarTutor($formularioMod['email'], $formularioMod['telefono'], $formularioMod['oid'], $conexion);
        ?>
        <h1>Modificación registrada con éxito</h1>
        <a href="tutores.php">Aquí</a> para volver al listado de tutores.
    </div>
</body>
<?php cerrarConexionBD($conexion); ?>