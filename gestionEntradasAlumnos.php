<?php
    function insertarAlumno
    ($nombre, $apellidos, $numDni, $letraDni, $email, $fnac, $telefono, $conexion)
    {
        try {
            $fnacFormateada = DateTime::createFromFormat('Y-m-d', $fnac)->format('d-m-Y');
            $dniFinal = $numDni.$letraDni;
            $nombreFinal = $nombre." ".$apellidos;
            $stmt = $conexion->prepare('CALL INSERTAR_ALUMNO(:dni,:nombre,
                                       :fecha,:telefono,:email)');
            $stmt->bindParam(':dni',$dniFinal);
            $stmt->bindParam(':nombre',$nombreFinal);
            $stmt->bindParam(':fecha',$fnacFormateada);
            $stmt->bindParam(':telefono',$telefono);
            $stmt->bindParam(':email',$email);
            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
        return $stmt;
    }
    
    function insertarMatricula ($curso, $especialidad, $numDni, $letraDni, $conexion)
    {
        try {
            $oid;
            $dniFinal = $numDni.$letraDni;
            $anyo = (int)date('Y');
            $stmt = $conexion->prepare('SELECT OID_P FROM PERSONA WHERE DNI = :dni');
            $stmt->bindParam(':dni', $dniFinal);
            $stmt->execute();
            foreach ($stmt as $fila) {
                $oid = $fila['OID_P'];
            }

            $stmt = $conexion->prepare('CALL INSERTAR_MATRICULA(:anyo,:curso,:alm,:espec)');
            $stmt->bindParam(':anyo',$anyo);
            $stmt->bindParam(':curso',$curso);
            $stmt->bindParam(':alm',$oid);
            $stmt->bindParam(':espec',$especialidad);
            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
       return $stmt;
    }
    
?>