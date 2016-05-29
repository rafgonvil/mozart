<?php
function insertarAlumno($nombre, $apellidos, $numDni, $letraDni, $email, $fnac, $telefono, $conexion) {
	try {
		$fnacFormateada = DateTime::createFromFormat('Y-m-d', $fnac) -> format('d-m-Y');
		$dniFinal = $numDni . $letraDni;
		$nombreFinal = $nombre . " " . $apellidos;
		$stmt = $conexion -> prepare('CALL INSERTAR_ALUMNO(:dni,:nombre,
                                       :fecha,:telefono,:email)');
		$stmt -> bindParam(':dni', $dniFinal);
		$stmt -> bindParam(':nombre', $nombreFinal);
		$stmt -> bindParam(':fecha', $fnacFormateada);
		$stmt -> bindParam(':telefono', $telefono);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
	return $stmt;
}

function insertarMatricula($curso, $especialidad, $numDni, $letraDni, $conexion) {
	try {
		$oid;
		$dniFinal = $numDni . $letraDni;
		$anyo = (int)date('Y');
		$stmt = $conexion -> prepare('SELECT OID_P FROM PERSONA WHERE DNI = :dni');
		$stmt -> bindParam(':dni', $dniFinal);
		$stmt -> execute();
		foreach ($stmt as $fila) {
			$oid = $fila['OID_P'];
		}

        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
    
    function consultarTotalAlumnos($conexion)
    {
        try {
            $consulta = "SELECT COUNT(*) AS TOTAL FROM ALUMNO";
            $stmt = $conexion -> query($consulta);
            $res = $stmt->fetch();
            $total = $res['TOTAL'];
            return (int)$total;            
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
    
    function consultarEspecialidadAlumno($conexion, $oid)
    {
        try {
            $consulta = "SELECT ESPECIALIDAD.NOMBRE FROM TIENE, ESPECIALIDAD ".
                       "WHERE (TIENE.ALUMNO = :oid ".
                       "AND TIENE.ESPECIALIDAD = ESPECIALIDAD.OID_E)";
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
    
?>