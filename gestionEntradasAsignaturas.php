<?php

    function consultarEspecialidadAsignatura($conexion, $oid)
    {
        try {
            $consulta = "SELECT ESPECIALIDAD.NOMBRE FROM ESPECIALIDAD ".
                       "WHERE ESPECIALIDAD.OID_E = :oid ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':oid', $oid);
            $stmt->execute();
            $res = $stmt->fetch();
            return $res['NOMBRE'];          
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
	
	    function consultarProfesorAsignatura($conexion, $oid)
    {
        try {
            $consulta = "SELECT PERSONA.NOMBRE FROM PERSONA ".
                       "WHERE PERSONA.OID_P = :oid";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':oid', $oid);
            $stmt->execute();
            $res = $stmt->fetch();
            return $res['NOMBRE'];          
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
    
    function consultarCursoAsignatura($conexion, $oid)
    {
        try {
            $consulta = "SELECT MATRICULA.CURSO FROM MATRICULA ".
                       "WHERE MATRICULA.ALUMNO = :oid";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':oid', $oid);
            $stmt->execute();
            $res = $stmt->fetch();
            return $res['CURSO'];          
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }

?>