<?php
    function crearConexionBD() {
        $host = "oci:dbname=localhost/XE;charset=UTF8";
        $usuario = "IISSI";
        $contrasena = "iissi";
        $conexion = null;
        
        try {
            $conexion = new PDO($host,$usuario,$contrasena, array(PDO::ATTR_PERSISTENT => true));
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
        return $conexion;
    }
    
    function cerrarConexionBD($conexion) {
        $conexion = null;
    }
?>