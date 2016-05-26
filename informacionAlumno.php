<?php
    session_start();
    include_once("gestionBD.php");
    if (!isset($_SESSION['alumno'])) {
        Header("Location:alumnos.php");
    }
    
    $alumno = $_SESSION['alumno'];
    unset($_SESSION['alumno']);
    $conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Información Alumno</title>
    </head>
    <body>
        <h1>Panel de control</h1>
        <h3>Información sobre <?php echo $alumno['NOMBRE']; ?>:</h3>
    </body>
</html>
<?php cerrarConexionBD($conexion); ?>